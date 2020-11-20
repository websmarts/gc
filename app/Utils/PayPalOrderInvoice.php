<?php

namespace App\Utils;

use Illuminate\Support\Facades\Validator;

class PayPalOrderInvoice
{

    public $intent = 'CAPTURE';
    public $returnUrl ;
    public $cancelUrl ;

    protected $currencyCode = 'AUD';
    protected $items =[];

    public function __construct($referenceId, $description = '')
    {
        $this->referenceId = $referenceId; // our internal tracking id for transaction
        $this->description = $description; // appears in org account memo field in Paypal to help further identify transaction 
        $this->returnUrl = route(env('PAYPAL_RETURN_ROUTE_NAME'));
        $this->cancelUrl = route(env('PAYPAL_CANCEL_ROUTE_NAME'));
    }

    // public function getOrderBody()
    // {
    //     dd($this->items);
    // }

    public function addItem(array $item)
    {
        // validate item and push onto $this->items if valid
        // attrs = name'[description],price, tax, quanity
        $this->items[]=$item;      
        
    }

    /**
     * Calculates the total invoices amount
     */
    public function total()
    {
        $itemTotal = 0;
        $taxTotal = 0;

        $items = [];
        foreach($this->items as $item){

            $price = number_format($item['price'],2,'.','');
            $tax = number_format($item['tax'],2,'.','');

            $itemTotal += $price * $item['quantity'];
            $taxTotal += $tax;
        }

        return $itemTotal + $taxTotal;
    }

    public function makeBody()
    {
        $itemTotal = 0;
        $taxTotal = 0;

        $items = [];
        foreach($this->items as $item){

            $price = number_format($item['price'],2,'.','');
            $tax = number_format($item['tax'],2,'.','');

            $items[] = [
                'name'=>$item['name'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_amount' => ['currency_code'=>$this->currencyCode,'value' => $price ],
                'tax' => ['currency_code'=>$this->currencyCode,'value' => $tax],
            ];
            $itemTotal += $price * $item['quantity'];
            $taxTotal += $tax;
        }

       $res =[ 'amount' =>
                    [
                        'currency_code' => $this->currencyCode,
                        'value' => number_format($itemTotal + $taxTotal,2,'.',''),
                        'breakdown' => [
                            'item_total' => ['currency_code' => 'AUD', 'value' =>  number_format($itemTotal,2,'.','')],
                            'tax_total' => ['currency_code' => 'AUD', 'value' => number_format($taxTotal,2,'.','') ],
                        ],
                    ],
                'items' =>  $items,
                'reference_id' => $this->referenceId,
                ];
        if(!empty($this->description)){
            $res['description'] = $this->description;
        }

        return [
            'intent' => 'CAPTURE',
            'application_context' =>
            [
                'return_url' => $this->returnUrl,
                'cancel_url' => $this->cancelUrl,
            ],
            'purchase_units' =>
            [
                0 => $res,

            ],
        ];

    }

}
