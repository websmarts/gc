<?php

namespace App\Http\Controllers;


use App\Models\User;


use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ImpersonatorController extends Controller
{
    public function impersonate()
    {
        
        if( auth()->user()->can('impersonate-user') ){

            // Check for silly self impersonation request
            if(auth()->user()->email == request('switchuseremail')) {
                return redirect()->back()->with('flash','Seems you are trying to impersonate yourself ???' );
            }

            // See if User exists to impersonate
            if( $user = User::where('email',request('switchuseremail'))->first()) {
                Auth::user()->impersonate($user);
                return redirect('/dashboard')->with('flash','Manager impersonation request successful');
            }

            // See if Contact exists to impersonate
            if( $user = Contact::where('email',request('switchuseremail'))->first()) {
                Auth::user()->impersonate($user,'contact');
                return redirect('/dashboard')->with('flash','Contact impersonation request successful');
            }   
            
            return redirect()->back()->with('flash','Email address: ' . request('switchuseremail') .' was not found' );

             
        }

        abort(403); // Not authorized
    }

    public function stopImpersonate()
    {
        
        if(Auth::check()){
            Auth::user()->leaveImpersonation();
        }

        if(Auth::guard('contact')->check()){
            Auth::guard('contact')->user()->leaveImpersonation();
        }
        

        return redirect('/dashboard')->with('flash','Welcome back!');
    }
}
