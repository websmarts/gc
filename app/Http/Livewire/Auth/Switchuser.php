<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Switchuser extends Component
{
    
    public $email;

    public $switchUser;

    public function switch()
    {
        
        $this->validate([
                'email' => 'required:exists:users'
            ]);

        $this->switchUser = User::where('email',$this->email);
        // push current user onto queue
        pushCurrentUser();
        Auth::login($this->switchUser);

        return redirect('/');

        
    }
    public function render()
    {
        return view('livewire.auth.switchuser');
    }
}
