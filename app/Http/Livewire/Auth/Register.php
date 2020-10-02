<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{  
    public $email ='';
    public $password ='';
    public $passwordConfirm ='';

    public function updatedEmail()
    {
        $this->validate(['email' => 'unique:users']);
    }

    public function register()
    {
        $data = $this->validate([
            'email' =>'required|email|unique:users',
            'password'=>'required|min:6|same:passwordConfirm'
        ]);
        
        User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'uuid' => Str::uuid()
        ]);

        return redirect('/');
    }
    
    public function render()
    {
        return view('livewire.auth.register');
    }
}
