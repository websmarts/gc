<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RegisterOrganisation extends Component
{
    
    public $registrationSteps = [ 
        1 => 'toto',
        2 => 'todo',
        3 => 'todo',
        4 => 'todo',
    ];

    

   
    
    public function render()
    {
        return view('livewire.register-organisation');
    }
}
