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
        // if( auth('contact')->check() ){ //single contact manager
        //     return view('contact.dashboard');
        // }


        // Check if user is an Organisation Manager
        $organisations = auth()->user()->organisations;

       
        return view('manager.dashboard'); 
    }

}
