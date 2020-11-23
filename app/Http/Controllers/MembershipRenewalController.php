<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipRenewalController extends Controller
{
    public function index($membershipIdHash = false)
    {

        if(!$membershipIdHash){
            return view('membership.renewal-form-anonymous'); // no membership identifier in request
        }
    
        $hasher = app('hasher')->decode($membershipIdHash);

       if(empty($hasher)){
        session()->flash('message', 'Invalid request');
            return redirect('/');
        }
       
        
        $membership = Membership::findOrFail($hasher[0]);

        // Check if membership is already financial
        if($membership->isCurrentlyFinancial()){
            session()->flash('message', 'Membership, '.$membership->name .' is currently financial and not due for renewal');
            return redirect('/');
        }



        $onlinePayBy = (object)[];
        
        if($settings = (object) $membership->membershipType->organisation->settings) {
            
            if(isSet($settings->payment_handler) && strtoupper(trim($settings->payment_handler)) == 'PAYPAL'){
                $onlinePayBy->name = 'PAYPAL';
                if( $settings->PAYPAL_USE_SANDBOX == true 
                    && isSet($settings->PAYPAL_SANDBOX_CLIENT_ID)
                    && !empty($settings->PAYPAL_SANDBOX_CLIENT_ID)){
                    $onlinePayBy->clientID = $settings->PAYPAL_SANDBOX_CLIENT_ID;
                } elseif($settings->PAYPAL_USE_SANDBOX !== true 
                        && isSet($settings->PAYPAL_CLIENT_ID)
                        && !empty($settings->PAYPAL_CLIENT_ID)){
                        $onlinePayBy->clientID = $settings->PAYPAL_CLIENT_ID;

                }
            }
        }

        
        // TODO check if hashId has expiry attached and if expired or not
        //[id, time_has_was_made, expiry_hours]
    
        
        return view('membership.renewal-step-one',['membership'=>$membership,'onlinePayBy'=>$onlinePayBy]);

    }
}
