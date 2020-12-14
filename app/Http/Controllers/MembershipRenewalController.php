<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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



        
        
        // TODO check if hashId has expiry attached and if expired or not
        //[id, time_has_was_made, expiry_hours]
    
        
        return view('membership.renewal-step-one',['membership'=>$membership]);

    }

    public function recordPayment($membershipIdHash){

        $hasher = app('hasher')->decode($membershipIdHash);
        $membership = Membership::findOrFail($hasher[0]);
       
     $details = request()->details;

       $transactionData = [
        'type' =>'payment', // eg invoice, refund, adjustment, etc
        'regarding' =>'membership renewal', // eg [membership/account] renewal
        'membership_id' =>$membership->id, // eg membership_id
        'organisation_id' =>$membership->membershipType->organisation_id, // organisation_id
        'gross_amount_charged' =>$membership->membershipType->membershipFeeAsDollars, // gross invoice amount
        'processors_transaction_id' =>$details['id'], // payment gateway transaction id
        'response_status_code' => $details['status'], // eg 201 = all good
        'payee_name' =>$details['payer']['name']['given_name'] .' '.$details['payer']['name']['surname'] ,
        'gross_amount_paid' =>$details['purchase_units'][0]['amount']['value'], // the amount actuall charged to the payee
        'when_received' => Carbon::now(), // timestamp 
        'created_by' => 0, // user id if manually done or 0 = system
        'note' =>'paypal renewal payment', // eg why adjustment was made
    ];  
     Transaction::create($transactionData);     



        // details of paypal transaction in request->details.
        Log::info(request()->details);

        return ['status'=>'success'];
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
