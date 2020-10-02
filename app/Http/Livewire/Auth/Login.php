<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Component 
{
    
    public $email;

    public $password;

    public $remember = false;

    public $loginfailed = false;

    public $domain = 'contact';

    public function updating()
    {
        $this->loginfailed = false;
    }
    
    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
    
        $credentials = ['email'=>$this->email, 'password'=>$this->password];

        $remember = (int) $this->remember > 0 ? true : false;

        if ($this->domain != 'contact' && Auth::attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        if ($this->domain == 'contact' && Auth::guard('contact')->attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        $this->loginfailed = true;
        
    }
}
