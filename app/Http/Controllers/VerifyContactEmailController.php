<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class VerifyContactEmailController extends Controller
{
    
    public function verify($token)
    {
        
        if(!$contact = Contact::where('email_verification_token',$token)->first() ){
            session()->flash('error-message','Verification process did not complete. This can happen if you have you already verified your email?');
            return redirect('/');
        }

        $contact->email_verified_at = $contact->freshTimestamp();
        $contact->email_verification_token = null;
        $contact->save();
        session()->flash('message','Your email has now been verified');
        return redirect('/');
    }
}
