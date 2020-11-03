<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Membership;
use Illuminate\Support\Str;
use App\Models\Contact as Member;

class MembershipMembers extends Component
{
    public $membershipId;

    public $membershipTypes;

    public $membership;

    public $editing; // member model for edit modal
    public $is_primary_contact = false;

    public $showModal = false;

    public $showConfirmDeleteMemberModal = false;

    public function rules()
    {
        return  $this->is_primary_contact ? [
            'editing.name' => 'required',
            'editing.email' => 'required|email',
            'editing.phone' => 'required',
            'is_primary_contact' => 'required'
    
        ] : [
            'editing.name' => 'required',
            'editing.email' => 'sometimes|required|email',
            'editing.phone' => 'sometimes|required',
            'is_primary_contact' => 'required'
        ];
    }

    public function create()
    {
        // Check if max people has been reached
        if ($this->membership->membershipType->max_people > $this->membership->members->count()) {
            $this->editing = Member::make();

            $this->showModal = true;
        }
    }

    public function edit($uuid)
    {

        $this->editing = $this->membership->members->where('uuid', $uuid)->first();
    
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

            // TODO Attach new member to membership WITH is_primary_contact bit set correctly!!!!
            $this->membership->members()->attach($this->editing->id, ['is_primary_contact' => $this->is_primary_contact]);
        } else {
            // we edited an existing member

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
