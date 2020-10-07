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

    public $show = true;

    public $loginfailed = '';

    public $formname; // needs to be loginform 

    

   

    public function updating()
    {
        $this->loginfailed = '';
    }

    public function closeform()
    {
        $this->loginfailed ='';
        $this->email = '';
        $this->password = '';
    }
    
    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
    
        $credentials = ['email'=>$this->email, 'password'=>$this->password];

        $remember = (int) $this->remember > 0 ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('dashboard');
        }

       

        $this->loginfailed = 'Login failed ...';
        
    }
}
