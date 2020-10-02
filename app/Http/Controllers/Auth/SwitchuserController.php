<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SwitchuserController extends Controller
{
    public function switchuser()
    {
        
        
        
        // save the current user - should be sysadmin
        $currentUserId = Auth::user()->id;

        
        

        // login new user by email
        if($user = User::where('email',request()->input('switchuseremail'))->first()) {

            Auth::login($user);

            session(['switched_user_id'=>$currentUserId]);

            
        }

        return redirect()->back();

    }
}
