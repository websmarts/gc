<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CreateAccount extends Component
{

    public $email = '';
    public $password;
    public $name;
    public $organisationName;

    public $user = null;

    // Form sections

    public $showEmail = true;
    public $showManagerName = false;
    public $showPassword = false;
    public $showOrganisationName = false;



    public function updatedEmail()
    {
        $this->validate(['email' => 'required|email']);
    }

    public function continue()
    {


        $this->user = User::where('email', $this->email)->first();
        if (!$this->user) {
            $this->showPassword = true;
            $this->showManagerName = true;
            $this->showOrganisationName = true;
        } else {
            $this->showOrganisationName = true;
        }
    }

    public function render()
    {
        return view('livewire.create-account');
    }
}
