<?php

namespace App\Utils;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {
        if(env('PAYPAL_USE_SANDBOX')){
            $clientId = env("PAYPAL_SANDBOX_CLIENT_ID");
            $clientSecret = env("PAYPAL_SANDBOX_CLIENT_SECRET");
        } else {
            $clientId = env("PAYPAL_LIVE_CLIENT_ID");
            $clientSecret = env("PAYPAL_LIVE_CLIENT_SECRET");
        }
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}