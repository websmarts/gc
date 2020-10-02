<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        
        // Check for system admin user
        if(auth()->user()->is_admin){ // sysadmin


            return view('admin.dashboard');
        }


        // Check if user is a contact an can only manage their own contact details 
        if( auth('contact')->check() ){ //single contact manager
            return view('contact.dashboard');
        }


        // Check if user is an Organisation Manager
        $organisations = auth()->user()->organisations;

        // check if the user is the manager of any organisations
        if(! $organisations->count()){
            $message = 'Login account is not associated with any organisation';
            
            $dudUser = auth()->user(); // remember this user with no organisations
            $dudUser()->leaveImpersonation(); // attempt to restore impersonator user if exists

            // Check if we have switched back to sysadmin user
            if( auth()->check() && auth()->user()->is_admin ) {
                // okay dud login was caused by sysadmin impersonating them
                return redirect('/dashboard')->with('flash', 'Strange - the user had no Organisation(s) linked to them!!!');
            }

            // Dud login is now logged out - go to home
            return redirect('/')->with('flash','No linked organisations found');
            
        }
        return view('manager.dashboard',compact('organisations')); 
    }

}
