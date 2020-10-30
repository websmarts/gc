<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Membership;

class MembershipMembers extends Component
{
    public $membershipId;

    public $membershipTypes;

    public $membership;

    public $showModal = false;
    
    public function render()
    {
       
        $this->membershipTypes = selectedOrganisation()->membershipTypes;
       
        $this->membership = Membership::with('members')->find($this->membershipId);
        
        return view('livewire.membership-members');
    }
}
