<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Membership;
use App\Events\MembershipDeleted;
use App\Models\Contact as Member;
use App\Models\ContactMembership;




class MembersRegister extends Component
{
    public $memberships;
    public $membershipTypes;

    public $editing; // Membership Model
    public $showEditMembershipModal = false;
    public $showConfirmDeleteMembershipModal = false;

    protected $rules =  [
        'editing.name'=>'required',
        'editing.membership_type_id' => 'required',
        'editing.start_date_for_display' => 'required',
        'editing.status' => 'required',
    ];

    public function edit(Membership $membership)
    {
        $this->editing = $membership;
        $this->showEditMembershipModal = true;
    }

    public function saveMembership()
    {
        $this->editing->save();
        $this->showEditMembershipModal = false;
    }

    public function deleteMembership()
    {
        // Delete the $this->editing model
        // and delete any contacts associated with it if they only belong to this membership
        // and delete and outstanding transactions for this membership
        // maybe just fire an event that membership was deleted and take care of business there
        // Keep in mind the delete is a soft delete for now, we may choose to do a hard delete once 
        // the delete tidy up has been done


        // TODO write the event listner code to delete contacts and other cleanup
        // When a member is deleted.
        //event(new MembershipDeleted($this->editing));
        $this->editing->delete();

        // Close both modals
        $this->showConfirmDeleteMembershipModal = false;
        $this->showEditMembershipModal = false;

    }
  
    public function render()
    {
        $this->memberships = auth()->user()->selectedOrganisation()->memberships()->with('members','membershipType')->get();
        $this->membershipTypes = auth()->user()->selectedOrganisation()->membershipTypes;
       
        return view('livewire.members-register');
    }
}
