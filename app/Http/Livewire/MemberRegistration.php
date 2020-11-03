<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use App\Models\Membership;
use App\Models\Organisation;
use App\Models\MembershipType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MemberRegistration extends Component
{

    public Organisation $organisation;
    public $membershipTypes;

    public $membership_name;
    public $membership_type_id;
    public $contact_name;
    public $contact_email;
    public $contact_phone;



    public function rules()
    {
        return [
            'membership_name' => 'required',
            'membership_type_id' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
        ];
    }



    public function mount($uuid = null)
    {
        $this->organisation = Organisation::where('uuid', $uuid)->firstOrFail();
        $this->membershipTypes = $this->organisation->membershipTypes;
    }

    public function create()
    {
        $data = $this->validate();
        // Create the membership

        $membershipType = MembershipType::where('id', $this->membership_type_id)->first();


        $membership = Membership::create([
            'name' => $data['membership_name'],
            'membership_type_id' => $membershipType->id,
            'fee_due_date' => Carbon::now(),
            'fee_due_amount' => $membershipType->membership_fee,
            'status' => 'pending'
        ]);

        $contact = Contact::create([
            'name' => $data['contact_name'],
            'organisation_id' => $this->organisation->id,
            'phone' => $data['contact_phone'],
            'email' => $data['contact_email'],
        ]);

        $membership->members()->attach($contact, ['is_primary_contact' => true]);

    }

    public function render()
    {
        return view('livewire.member-registration');
    }
}
