<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Rules\inputdate;
use App\Models\Membership;
use App\Models\Transaction;
use App\Models\Organisation;
use Illuminate\Support\Carbon;
use App\Events\MembershipDeleted;
use App\Models\Contact as Member;
use App\Models\ContactMembership;
use App\Models\MembershipRenewal;
use Illuminate\Support\Facades\Cache;
use App\Jobs\SendMembershipRenewalEmail;

class MembersRegister extends Component
{
    public $organisationId;

    public $selected = [];
    public $selectAll = false;

    public $search = '';

    public $editing; // Membership Model
    public $proxy_start_date; // temp holder for editing.start_date
    // public $proxy_last_paid_date; // temp holder for editing.start_date
    public $transaction; // instance of App\Models\Transaction



    public $showEditMembershipModal = false;
    public $showConfirmDeleteMembershipModal = false;

    public $showRenewButton = false;
    public $showSelectAll = 0;

    public function rules()
    {
        return $rules =  [
            'editing.name' => 'required',
            'editing.membership_type_id' => 'required',
            'proxy_start_date' => ['nullable', new inputdate],
            // 'proxy_last_paid_date' => ['nullable', new inputdate],
            'editing.status' => 'required',
            'editing.last_paid_amount' => 'sometimes',
            'transaction.gross_amount_paid' =>'sometimes',
            //'transaction.when_received'=> 'sometimes',
            'transaction.note'=> 'sometimes'

        ];
    }

    public function mount()
    {
        $this->organisationId = selectedOrganisation()->id;
        Cache::forget('organisation' . $this->organisationId);
    }

    public function updatedSelectAll()
    {

        foreach ($this->organisation->memberships as $m) {
            if ($m->isRenewable()) {
                $this->selected[$m->id] = $this->selectAll;
            } elseif (isset($this->selected[$m->id])) {
                unset($this->selected[$m->id]);
            }
        }
        $this->updatedSelected('all'); // pass all to flag it is the selecteAll causing the update and not a single checkbox
    }

    public function updatedSelected($field = null)
    {

        if ($field != 'all') { // single checkbox clicked
            $this->selectAll = false; // uncheck the select-all checkbox
        }

        $this->showRenewButton = collect($this->selected)->filter(function ($value) {
            return $value;
        })->count();
    }

    



    public function getCheckboxCountProperty()
    {
        $this->showSelectAll = count($this->selected);
        return $this->showSelectAll;
    }

    public function getRenewalCountProperty()
    {

        $this->showRenewButton = collect($this->selected)->filter(function ($value) {
            return $value;
        })->count();

        return $this->showRenewButton;
    }


    public function updated($name, $value)
    {
        if ($name == 'proxy_start_date') {
            $this->proxy_start_date = str_replace('/', '-', $value);
        }

        if ($name == 'search') {
            $this->selectAll = false;

            Cache::forget('organisation' . $this->organisationId);
        }
    }

    public function sendRenewals()
    {
        $selectedMembershipIds = collect($this->selected)->filter(function ($value) {
            return $value;
        })->keys();

        // process each selected renewal
        $selectedMembershipIds->each(function ($mid, $key) {

            $m = Membership::find($mid);

            unset($this->selected[$mid]);

            if ($m->isNotRenewable()) { // skip if should not be sent renewal
                return;
            }
            // Prepare the email data
            $primaryContact = $m->primaryContact();

            // Check primary contact actually has an email to send to
            if ($primaryContact && $primaryContact->verifiedEmailAddress()) {

                // Create the renewal request record
                MembershipRenewal::create([
                    'membership_id' => $m->id,
                    'issued_date' => Carbon::now(),
                ]);

                $details = [
                    //'email' => $primaryContact->verifiedEmailAddress(),
                    'email' =>auth()->user()->email,
                    'membership_id_hash' => app('hasher')->encode([$m->id, time(), 24]), // id,now time, hours to expiry
                    'organisation_name' => selectedOrganisation()->name,
                    'primary_contact' => $primaryContact->name,
                    'membership_name' => $m->name,
                    'subscription_period_end_date' => $m->membershipType->currentSubscriptionPeriod()->end_date->addDay(-1)->format('d-m-Y'),
                    'subscription_period_start_date' => $m->membershipType->currentSubscriptionPeriod()->start_date->format('d-m-Y'),
                ];

                dispatch(new SendMembershipRenewalEmail($details));
            }
        });
        Cache::forget('organisation' . $this->organisationId);
    }

    public function edit(Membership $membership)
    {
        $this->editing = $membership;

        $this->transaction = Transaction::make();

        $this->proxy_start_date = optional($this->editing->start_date)->format('d-m-Y');
        $this->showEditMembershipModal = true;
    }

    

    /**
     * Save Membership
     */
    public function saveMembership()
    {
        $this->validate();

        

        $this->editing->start_date = new Carbon($this->proxy_start_date); // proxy date must be in dd-mm-yyyy NOT dd/mm/yyyyformat
        $this->editing->save();

        //check if a payment was added
        if((float) $this->transaction->gross_amount_paid != 0){
            
            $this->transaction->gross_amount_charged =  $this->editing->membershipType->membershipFeeAsDollars;
            $this->transaction->membership_id = $this->editing->id;
            $this->transaction->organisation_id = selectedOrganisation()->id;
            $this->transaction->type = 'payment';
            $this->transaction->regarding = 'Membership renewal';
            $this->transaction->when_received= Carbon::now(); // Just use when entered as when_received date

            $this->transaction->save();
            
        }
        
        $this->transaction = Transaction::make();



        $this->showEditMembershipModal = false;
        Cache::forget('organisation' . $this->organisationId);
    }

    public function deleteMembership()
    {

        $this->editing->delete();

        // Close both modals and forget cached query
        $this->showConfirmDeleteMembershipModal = false;
        $this->showEditMembershipModal = false;
        Cache::forget('organisation' . $this->organisationId);
    }


    /**
     * Use computed property  to minimise the hydration loading 
     * and maximise benefits of caching
     */
    public function getOrganisationProperty()
    {
        $search = $this->search;

        return  Cache::remember('organisation' . $this->organisationId, 600, function () use ($search) {

            return Organisation::with([
                'memberships' => function ($q) use ($search) {
                    $q->where('memberships.name', 'like', '%' . $search . '%');
                },
                'membershipTypes',
                'memberships.membershipType',
                'memberships.members',
                'memberships.latestRenewalNoticeQuery',
                'memberships.latestRenewalPaymentQuery'
            ])->find($this->organisationId);
        });
    }

    public function render()
    {
        return view('livewire.members-register');
    }
}
