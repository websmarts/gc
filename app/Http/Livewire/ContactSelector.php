<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactSelector extends Component
{
    public $organisation;
    public $contacts;

    public function mount()
    {
        $this->contacts = $this->organisation->contacts;
    }
    
    public function render()
    {
        return view('livewire.contact-selector');
    }
}
