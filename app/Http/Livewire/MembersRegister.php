<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Rules\inputdate;
use App\Models\Membership;
use Illuminate\Support\Carbon;
use App\Events\MembershipDeleted;
use App\Models\Contact as Member;
use App\Models\ContactMembership;
use App\Jobs\SendMembershipRenewalEmail;
use App\Models\MembershipRenewal;

class MembersRegister extends Component
{
    
    public $memberships;
    public $membershipTypes;

    public $selected = [];
    public $selectAll = false;

    public $search = '';
    public $orderBy = 'name';
    public $sortOrder = 'asc';

    public $editing; // Membership Model
    public $proxy_start_date; // temp holder for editing.start_date
    // public $proxy_last_paid_date; // temp holder for editing.start_date



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
        ];
    }

    public function mount()
    {
        
        $this->membershipTypes = selectedOrganisation()->membershipTypes;
    }

    public function orderBy($field)
    {
        if ($this->orderBy == $field) {
            $this->sortOrder = $this->sortOrder == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortOrder = 'asc';
        }
        $this->orderBy = $field;
    }

    public function updatedSelectAll()
    {

        foreach ($this->memberships as $m) {
            if($m->isRenewable()){
                $this->selected[$m->id] = $this->selectAll;
            } elseif (isSet($this->selected[$m->id])) {
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

        // $this->showRenewButton = collect($this->selected)->filter(function ($value) {
        //     return $value;
        // })->count();
    }

    public function getOrganisationProperty()
    {
        return selectedOrganisation();
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

            if( $m->isNotRenewable() ){ // skip if should not be sent renewal
                return;
            }

            // Create the renewal request record
            MembershipRenewal::create([
                'membership_id' => $m->id,
                'issued_date' => Carbon::now(),
            ]);

           
            // Prepare the email data
            $primaryContact = $m->members->where('pivot.is_primary_contact', true)->first();
            $details = [
                'email' => $primaryContact->email,
                'membership_id_hash' => app('hasher')->encode([$m->id, time(), 24]),
                'organisation_name' => "Neerim and District Landcare Group",
                'primary_contact' => $primaryContact->name,
                'membership_name' => $m->name,
                'subscription_period_end_date' => '1-' . $m->membershipType->renewal_month . '-' . date('Y'),
            ];

            dispatch(new SendMembershipRenewalEmail($details));
        });
    }



    public function edit(Membership $membership)
    {
        $this->editing = $membership;

        $this->proxy_start_date = optional($this->editing->start_date)->format('d-m-Y');
        // $this->proxy_last_paid_date = optional($this->editing->last_paid_date)->format('d-m-Y');
        $this->showEditMembershipModal = true;
    }

    /**
     * Save Membership
     */
    public function saveMembership()
    {
        $this->validate();

        $this->editing->start_date = new Carbon($this->proxy_start_date); // proxy date must be in dd-mm-yyyy NOT dd/mm/yyyyformat
        // $this->editing->last_paid_date = new Carbon($this->proxy_last_paid_date);

        $this->editing->save();
        $this->showEditMembershipModal = false;
    }

    public function deleteMembership()
    {

        $this->editing->delete();

        // Close both modals
        $this->showConfirmDeleteMembershipModal = false;
        $this->showEditMembershipModal = false;
    }

    public function render()
    {
        $this->memberships = selectedOrganisation()->memberships()
            ->where('memberships.name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->orderBy, $this->sortOrder)
            ->with(['members', 'membershipType'])
            ->get();
        // $this->memberships = Membership::join('membership_types','memberships.membership_type_id','=','membership_types.id')
        // ->where('membership_types.organisation_id',selectedOrganisation()->first()->id)
        // ->join('contacts_memberships','memberships.id','=','contacts_memberships.membership_id')
        // ->join('contacts','contacts_memberships.contact_id','=','contacts.id')
        // ->select(
        //     'memberships.*',
        //     'membership_types.name as membership_type_name',
        //     'contacts_memberships.is_primary_contact',
        //     'contacts.name as contact_name')
        // ->get();
        // dd($this->memberships->first()->toArray());

        return view('livewire.members-register');
    }
}
