<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateMembership extends Component
{
    public $membershipTypes;

    public $membershipTypeId;

    public $membershipName;

    public $contacts = [];

    public function mount()
    {
        $this->membershipTypes = auth()->user()->selectedOrganisation()->membershipTypes;
        $this->membershpTypeId = $this->membershipTypes->first()->id; 
    }
    
    public function render()
    {
        return view('livewire.create-membership');
    }
}
