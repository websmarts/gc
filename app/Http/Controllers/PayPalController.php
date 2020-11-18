<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Utils\PayPalGetOrder;
use Illuminate\Support\Carbon;
use App\Utils\PayPalCreateOrder;
use App\Utils\PayPalCaptureOrder;
use App\Utils\PayPalOrderInvoice;
use Illuminate\Support\Facades\Log;


class PayPalController extends Controller
{
    
    /**
     * Prepares membership renewal invoice and 
     * submits to PayPal for Payment
     * 
     * param $hashId is the hashId of the membership being invoiced
     * 
     * returns JSON response to paypal js client
     * with orderID set to the value returned from PayPal
     * CreateOrder
     */
    public function membershipRenewalPayment($hashId)
    {
       $id = getIdFromHashId($hashId);

        $membership = Membership::findOrFail($id);

        // (1) Create new invoice
        $invoice = new PayPalOrderInvoice($hashId);
        // (2) Add line items to invoce

        $tax = $membership->membershipType->organisation->gst_registered ? ($membership->membershipType->membershipFeeAsDollars / 10) : 0;
        $price = $membership->membershipType->membershipFeeAsDollars - $tax;
        $item = [
            'name' => $membership->membershipType->name . ' membership renewal',
            'description' => $membership->membershipType->organisation->name,
            'quantity' => 1,
            'price' => $price,
            'tax' => $tax,
        ];
        $invoice->addItem($item);
        

        // submit invoice for payment 

        $response = PayPalCreateOrder::createOrder($invoice);

        // TODO if okay status code=201 then create a transaction table entry
        if($response->statusCode == '201'){
            Transaction::create([
                'type'=>'invoice',
                'regarding' => 'membership renewal',
                'membership_id' =>$membership->id,
                'gross_amount_charged'=>$invoice->total(),
                'processors_transaction_id' => $response->result->id,
                'response_status_code' => $response->statusCode,

            ]);
        }
        // with transaction_id set to $response->result->id

        //Log::info('response',[$response]);


        // return id only;
        return response()->json(['orderID' => $response->result->id]);
        // return $response->result->id;
    }

    public function get(Request $request)
    {
        PayPalGetOrder::getOrder($request->orderID);
    }

    public function capture(Request $request)
    {
        $response = PayPalCaptureOrder::captureOrder($request->orderID, false);

        // TODO update membership model and issue MemebershipPayemntCompleted event (if it was)
        $hashId = $response->result->purchase_units[0]->reference_id; 


        // TODO update the transaction record with the transaction_id = $response->result->id
        // with the paid amounts and payer details
        if($response->statusCode == 201 && $response->result->status == 'COMPLETED'){
        $transaction = Transaction::where('processors_transaction_id',$response->result->id)->first();
        $transaction->payee_name = $response->result->purchase_units[0]->shipping->name->full_name;
        $transaction->gross_amount_paid = $response->result->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
        $transaction->net_amount_received = $response->result->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
        $transaction->when_received = Carbon::now();

        $transaction->save();

        }
        
        Log::info('capture response',['response'=> $response]);
        return response()->json($response->result);
    }

    public function paypalReturn()
    {
        dd(request()->all());
    }
    public function paypalCancel()
    {
        dd(request()->all());
    }
}
