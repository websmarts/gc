<?php

namespace App\Utils;

use App\Utils\PayPalClient;
use App\Utils\PayPalCartOrder;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;



class PayPalCreateOrder
{


    public static function createOrder($invoice,$payPalCredentials)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = $invoice->makeBody();
        // $request->body = self::buildRequestBody();
        // 3. Call PayPal to set up a transaction

        


        $client = PayPalClient::client($payPalCredentials);
        $response = $client->execute($request);

        return $response;
    }

    /**
     * Setting up the JSON request body for creating the order with minimum request body. The intent in the
     * request body should be "AUTHORIZE" for authorize intent flow.
     *
     */
    private static function buildRequestBody()
    {
        return [
            'intent' => 'CAPTURE',
            'application_context' =>
            [
                'return_url' => 'http://localhost:8000/paypal-return',
                'cancel_url' => 'http://localhost:8000//paypal-cancel'
            ],
            'purchase_units' =>
            [
                0 =>
                [
                    'amount' =>
                    [
                        'currency_code' => 'AUD',
                        'value' => '25.00',
                        'breakdown' => [
                            'item_total' => ['currency_code' => 'AUD', 'value' => '22.50'],
                            'tax_total' => ['currency_code' => 'AUD', 'value' => '2.50'],
    
                        ],
                    ],
                    
                    'items' => [
                        [
                            'name' => 'Landcare Membership Renewal',
                            'description' => 'Neerim District Landcare Group',
                            'sku' => 'sku01',
                            'unit_amount' =>
                            [
                                'currency_code' => 'AUD',
                                'value' => '22.50',
                            ],
                            'tax' =>
                            [
                                'currency_code' => 'AUD',
                                'value' => '2.50',
                            ],
                            'quantity' => '1',
                            'category' => 'PHYSICAL_GOODS',
                        ],

                    ],
                    'reference_id' => 'BWdeM',
                    'description' => 'Membership renewal for NDLG',
                ]
            ]
        ];
    }
}
