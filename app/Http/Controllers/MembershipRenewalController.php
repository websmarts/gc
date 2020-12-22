<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class MembershipRenewalController extends Controller
{
    
    
    /**
     * Displays the membership renewal page
     */
    public function index($membershipIdHash = false)
    {

        if (!$membershipIdHash) {
            return view('membership.renewal-form-anonymous'); // no membership identifier in request
        }

        $hasher = app('hasher')->decode($membershipIdHash);

        if (empty($hasher)) {
            session()->flash('message', 'Invalid request');
            return redirect('/');
        }

        // It is possible the membership has already been cancelled/deleted
        // so we need to cater for that scenarion
        $membership = Membership::withTrashed()->findOrFail($hasher[0]);
        if ($membership->deleted_at) {
            session()->flash('message', 'Membership, ' . $membership->name . ' is no longer active');
            return redirect('/');
        }



        // Also check if membership is already financial. If they are
        // then they don't need to pay again!!
        if ($membership->isCurrentlyFinancial()) {
            session()->flash('message', 'Membership, ' . $membership->name . ' is currently financial and not due for renewal');
            return redirect('/');
        }

        return view('membership.renewal-step-one', ['membership' => $membership]);
    }

    /**
     * An XHR call from paypal js script to record the approved transaction details
     */
    public function recordPayment($membershipIdHash)
    {

        $hasher = app('hasher')->decode($membershipIdHash);
        $membership = Membership::findOrFail($hasher[0]);

        $details = request()->details;

        $transactionData = [
            'type' => 'payment', // eg invoice, refund, adjustment, etc
            'regarding' => 'membership renewal', // eg [membership/account] renewal
            'membership_id' => $membership->id, // eg membership_id
            'organisation_id' => $membership->membershipType->organisation_id, // organisation_id
            'gross_amount_charged' => $membership->membershipType->membershipFeeAsDollars, // gross invoice amount
            'processors_transaction_id' => $details['id'], // payment gateway transaction id
            'response_status_code' => $details['status'], // eg 201 = all good
            'payee_name' => $details['payer']['name']['given_name'] . ' ' . $details['payer']['name']['surname'],
            'gross_amount_paid' => $details['purchase_units'][0]['amount']['value'], // the amount actuall charged to the payee
            'when_received' => Carbon::now(), // timestamp 
            'created_by' => 0, // user id if manually done or 0 = system
            'note' => 'paypal renewal payment', // eg why adjustment was made
        ];

        Transaction::create($transactionData);

        //Log::info(request()->details);

        return ['status' => 'success'];
    }

    /**
     * Displays the view after membership payment has been successful 
     */
    public function confirm($membershipIdHash)
    {
        $membership = Membership::with('members', 'members.address')->findOrFail(app()->hasher->decode($membershipIdHash)[0]);

        return view('membership.renewal-confirmed', compact('membership'));
    }

    /**
     * Called if member chooses the pay-offline option
     */
    public function offline($membershipIdHash)
    {
        // record they selected offline
        $membership = Membership::with('members', 'members.address')->findOrFail(app()->hasher->decode($membershipIdHash)[0]);

        $membership->note = 'Selected pay offline renewal option ' . Carbon::now()->format('d-m-Y') . "\r\n" . $membership->note;
        $membership->save();

        return view('membership.renew-offline-details', compact('membership', 'membershipIdHash'));
    }
}
