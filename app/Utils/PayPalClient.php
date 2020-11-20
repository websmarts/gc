<?php

namespace App\Utils;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client($credentails)
    {
        return new PayPalHttpClient(self::environment($credentails));
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment($credentials)
    {
       
            $clientId = $credentials['clientId'];
            $clientSecret = $credentials['clientSecret'];

            if($credentials['environment'] == 'sandbox'){
                return new SandboxEnvironment($clientId, $clientSecret);
            }
            if($credentials['environment'] == 'production'){
                //return new ProductionEnvironment($clientId, $clientSecret);
            }
            
        
        
    }
}