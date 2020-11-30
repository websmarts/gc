<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
       
        
        $membership = Membership::withTrashed()->findOrFail($hasher[0]);

        // Check if membership has already been deleted
        if($membership->deleted_at){
            session()->flash('message', 'Membership, '.$membership->name .' is no longer active');
            return redirect('/');
        }



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

    public function confirm($membershipIdHash){

        // display a view with:
        // Confirmation message
        // Current membership details
        // and offer option to update

        $membership = Membership::with('members','members.address')->findOrFail(app()->hasher->decode($membershipIdHash)[0]);

        return view('membership.renewal-confirmed', compact('membership'));
    }

    public function offline($membershipIdHash)
    {
        // record they selected offline
        $membership = Membership::with('members','members.address')->findOrFail(app()->hasher->decode($membershipIdHash)[0]);

        $membership->note = 'Selected pay offline renewal option ' . Carbon::now()->format('d-m-Y') ."\r\n" . $membership->note;
        $membership->save();

        // display offline renewal page details

        return view('membership.renew-offline-details',compact('membership','membershipIdHash'));

    }
}
