<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use App\Models\Membership;
use Illuminate\Support\Facades\DB;

class CreateMembership extends Component
{
    public $membershipTypes; // reference data

    public $membership; // Model for Membership creation 
    public $contact; // Model for Contact creation

    public $showModal = false; // Show Add/Edit Member form

    public function rules()
    {
        if($this->showModal){
            return [
                // Edit?add rules
            ];
        }
        return [
            'membership.membership_type_id' =>'required',
            'membership.name' => 'required|min:8|max:30',
            'membership.status' => 'required',
            'contact.name' => 'required',
            'contact.email' => 'required|email',
            'contact.phone' => 'required',
        ];
    }

    public function mount()
    {
        $this->membershipTypes = auth()->user()->selectedOrganisation()->membershipTypes;
        $defaultMembershpTypeId = $this->membershipTypes->first()->id; 
        $this->membership = Membership::Make(['membership_type_id'=>$defaultMembershpTypeId]);
        $this->contact = Contact::make();
        
    }

    public function createMembership()
    {
        $this->validate();

        // Add needed organisation_id to contact model before saving
        $this->contact->organisation_id = auth()->user()->selectedOrganisation()->id;
        
        

        DB::transaction(function(){
            $this->membership->save();
            $this->contact->save();
        });

        $this->membership->refresh()->members()->attach($this->contact->refresh(),['is_primary_contact'=> true]);


    }
   
    public function render()
    {
        return view('livewire.create-membership');
    }
}
