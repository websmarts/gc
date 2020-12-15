<?php

namespace App\Http\Livewire;

use App\Models\State;
use App\Models\Address;
use Livewire\Component;
use App\Models\Membership;
use Illuminate\Support\Str;
use App\Models\Contact as Member;
use Illuminate\Support\Facades\Validator;

class MembershipMembers extends Component
{
    public $membershipId;

    public $membershipTypes;

    public $membership;

    public $states;

    public $editing; // member model for edit modal
    public $is_primary_contact = false;
    public $address; // member address 

    public $showModal = false;

    public $showConfirmDeleteMemberModal = false;

    public function rules()
    {
        if($this->is_primary_contact){
            return  [
                'editing.name' => 'required',
                'editing.email' => 'required|email',
                'editing.phone' => 'required',
                'is_primary_contact' => 'required',
                'address.address1' => 'required',
                'address.address2' => 'sometimes',
                'address.city' => 'required',
                'address.postcode' => 'required',
                'address.state_id' =>'required'
    
        
           ];

        }
         elseif (  !empty($this->address->address1) 
                    || !empty($this->address->address2) 
                    || !empty($this->address->city )
                    || !empty($this->address->postcode)) {

            return [
                'editing.name' => 'required',
                'editing.email' => 'sometimes|email',
                'editing.phone' => 'sometimes',
                'is_primary_contact' => 'required',
                'address.address1' => 'required',
                'address.address2' => 'sometimes',
                'address.city' => 'required',
                'address.postcode' => 'required',
                'address.state_id' =>'required'
    
            ];
        } else {
            return [
                'editing.name' => 'required',
                'editing.email' => 'sometimes|email',
                'editing.phone' => 'sometimes',
                'is_primary_contact' => 'required',
                'address.address1' => 'sometimes',
                'address.address2' => 'sometimes',
                'address.city' => 'sometimes',
                'address.postcode' => 'sometimes',
                'address.state_id' =>'sometimes'
                
    
            ];
        }
        
        
    }

    public function mount(){
        $this->states = State::get();
    }

    

    public function create()
    {
        // Check if max people has been reached
        if ($this->membership->membershipType->max_people > $this->membership->members->count()) {
            $this->editing = Member::make();
            $this->address = Address::make();

            $this->showModal = true;
        }
    }

    public function edit($uuid)
    {

        $this->editing = $this->membership->members->where('uuid', $uuid)->first();

        // get the address details - they nmaybe null
        if(!$this->address = $this->editing->address){
           
            $this->address = Address::make([
                'address1'=>'',
                'address2'=>'',
                'city'=>'',
                'state_id'=> '',
                'postcode'=>''
            ]);
        }
        
    
        $this->is_primary_contact = $this->editing->pivot->is_primary_contact;
        $this->showModal = true;
    }

    public function save()
    {
        
       $this->validate();

        if (!$this->editing->uuid) {
            // We are adding a new contact/member

            // Set the organisation 
            $this->editing->organisation_id = selectedOrganisation()->id;
            $this->editing->uuid = Str::uuid();
            $this->editing->save();

            $this->membership->members()->attach($this->editing->id, ['is_primary_contact' => $this->is_primary_contact]);
        } else {
            // we edited an existing member


            

            // if address save it
            if($this->address->id){
                // it must be an existing address as we have an address.id

                // If address fields are blank then delete it as its not a whole lot of use
                if (empty($this->address->address1) && empty($this->address->address2) && empty($this->address->city && empty($this->address->postcode))){
                    $this->address->delete();
                    $this->editing->address_id = null;
                } else {
                    // Its not all blank stuff so save the address
                    $this->address->save();
                }
                
            } elseif (!empty($this->address->address1) || !empty($this->address->address2) || !empty($this->address->city || !empty($this->address->postcode))){
                $this->address->save();
                // now $this-address will have an id so save that to this->editing
                $this->editing->address_id = $this->address->id;
            }

            $this->editing->save();
            $member = $this->membership->members->where('uuid', $this->editing->uuid)->first();
            $otherMemberIds = $this->membership->members->where('id','!=',$member->id)->pluck('id')->all();
            
            // primary_contact status may have changed - update pivit if it has
            if ($member->pivot->is_primary_contact != $this->is_primary_contact) {
                $this->membership->members()->updateExistingPivot($this->editing->id, ['is_primary_contact' => $this->is_primary_contact]);
            }
            if($this->is_primary_contact){
                // make sure all others are set to not be primary_contact
                $this->membership->members()->updateExistingPivot($otherMemberIds,['is_primary_contact'=>0]);
            }
        }

        $this->showModal = false;
    }

    public function deleteMember()
    {
        $this->membership->members()->detach($this->editing->id);
        
        $this->editing->delete();
        // close both modals.
        $this->showConfirmDeleteMemberModal = false;
        $this->showModal = false;
    }

    public function render()
    {

        $this->membershipTypes = selectedOrganisation()->membershipTypes;

        $this->membership = Membership::with('members')->find($this->membershipId);

        return view('livewire.membership-members');
    }
}
