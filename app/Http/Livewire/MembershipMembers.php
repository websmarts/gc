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

    public $showModal = false;

    public $showConfirmDeleteMemberModal = false;

    protected $rules = [
        'editing.name' => 'required',
        'editing.email' => 'nullable|required',
        'editing.phone' => 'nullable|required',

    ];

    public function create()
    {
        // Check if max people has been reached
        if ($this->membership->membershipType->max_people > $this->membership->members->count()) {
            $this->editing = Member::make();

            $this->showModal = true;
        }
    }

    public function edit(Member $member)
    {
        $this->editing = $member;
        $this->showModal = true;
    }

    public function save()
    {
        if(! $this->editing->uuid)
        {
            // We are adding a new contact/member

            // Set the organisation 
            $this->editing->organisation_id = selectedOrganisation()->id;
            $this->editing->uuid = Str::uuid();
            $this->editing->save();

            // Attach new member to membership 
            $this->membership->members()->attach($this->editing->refresh());
        } else {
            // we edited an existing member
            $this->editing->save();
        }
          
        $this->showModal = false;
    }

    public function deleteMember()
    {
        $this->editing->delete();
        $this->showConfirmDeleteMemberModal = false;
    }

    public function render()
    {

        $this->membershipTypes = selectedOrganisation()->membershipTypes;

        $this->membership = Membership::with('members')->find($this->membershipId);

        return view('livewire.membership-members');
    }
}
