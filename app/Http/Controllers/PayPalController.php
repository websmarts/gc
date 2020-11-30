<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Transaction;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\Utils\PayPalCreateOrder;
use App\Utils\PayPalCaptureOrder;
use App\Utils\PayPalOrderInvoice;
use Illuminate\Support\Facades\Log;


class PayPalController extends Controller
{
    
    protected $membership;
    
    
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

        $this->membership = Membership::findOrFail($id);
        $organisation = $this->membership->membershipType->organisation; // need org to get settings for paypal client later
        

        // (1) Create new invoice
        $invoice = new PayPalOrderInvoice($this->membership->id);
        // (2) Add line items to invoce

        $tax = $this->membership->membershipType->organisation->gst_registered ? ($this->membership->membershipType->membershipFeeAsDollars / 10) : 0;
        $price = $this->membership->membershipType->membershipFeeAsDollars - $tax;
        $item = [
            'name' => $this->membership->membershipType->name . ' membership renewal',
            'description' => $this->membership->membershipType->organisation->name,
            'quantity' => 1,
            'price' => $price,
            'tax' => $tax,
        ];
        $invoice->addItem($item);
        

        // submit invoice for payment 
        if(!$credentials = $this->getCredentials()) {

            // TODO Handle this error better eg flash message to user that org suddenly not setup for paypal???
            dd('INVALID ORGANISATION CREDENTIALS');
        }


        $response = PayPalCreateOrder::createOrder($invoice,$credentials); // pass org to get payment gateway settings

        // TODO if okay status code=201 then create a transaction table entry
        if($response->statusCode == '201'){
            Transaction::create([
                'type'=>'invoice',
                'regarding' => 'membership renewal',
                'membership_id' =>$this->membership->id,
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

    

    public function capture(Request $request)
    {
        
        // Need to get the organisation so we can get the paypal credentials

        // retrieve the Transaction from setup so we can get the membershipId
        // Log::info('capture request',['request'=> $request]);
        $transaction = Transaction::where('processors_transaction_id',$request->orderID)->latest()->first();
        // Log::info('capture transaction',['transaction'=> $transaction]);
        $this->membership = Membership::findOrFail($transaction->membership_id);


        // Log::info('capture membership',['membership'=> $this->membership]);
        
        $response = PayPalCaptureOrder::captureOrder($request->orderID, $this->getCredentials());

        // TODO update membership model and issue MemebershipPayemntCompleted event (if it was)
        $membershipId = $response->result->purchase_units[0]->reference_id; 


        // TODO update the transaction record with the transaction_id = $response->result->id
        // with the paid amounts and payer details
        if($response->statusCode == 201 && $response->result->status == 'COMPLETED'){
        $transaction = Transaction::where('processors_transaction_id',$response->result->id)->first();// hmm should it be the latest first?
        $transaction->payee_name = $response->result->purchase_units[0]->shipping->name->full_name;
        $transaction->gross_amount_paid = $response->result->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
        $transaction->net_amount_received = $response->result->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
        $transaction->when_received = Carbon::now();

        $transaction->save();

        }
        
        // Log::info('capture response',['response'=> $response]);
        return response()->json($response->result);
    }

    public function paypalReturn()
    {
        // TODO handle payPal return here??
        //dd(['paypal_return',request()->all()]);
    }
    public function paypalCancel(Request $request)
    {
        if(!Transaction::where('processors_transaction_id',$request->orderID)->forceDelete()){
            return false;
        }
        return true;
    }

    private function getCredentials()
    {
        $organisation = $this->membership->membershipType->organisation;
        
        if($settings = (object) $organisation->settings) {
            
            if($settings->payment_handler && strtoupper(trim($settings->payment_handler)) == 'PAYPAL'){
                
                if( $settings->PAYPAL_USE_SANDBOX == true 
                    && isSet($settings->PAYPAL_SANDBOX_CLIENT_ID)
                    && !empty($settings->PAYPAL_SANDBOX_CLIENT_ID)){
                    $credentials['clientId'] = $settings->PAYPAL_SANDBOX_CLIENT_ID;
                     $credentials['clientSecret'] = $settings->PAYPAL_SANDBOX_CLIENT_SECRET;
                     $credentials['environment'] = 'sandbox';

                     return $credentials;

                } elseif($settings->PAYPAL_USE_SANDBOX !== true 
                        && isSet($settings->PAYPAL_CLIENT_ID)
                        && !empty($settings->PAYPAL_CLIENT_ID)){
                        $credentials['clientId'] = $settings->PAYPAL_CLIENT_ID;
                        $credentials['clientSecret'] = $settings->PAYPAL_SANDBOX_CLIENT_SECRET;
                        $credentials['environment']= 'production';

                        return $credentials;

                }
                
            }
            
        } 
        return false;
    }
}
