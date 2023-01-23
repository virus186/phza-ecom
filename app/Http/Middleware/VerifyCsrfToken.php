<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
        /**
         * The URIs that should be excluded from CSRF verification.
         *
         * @var array
         */
        protected $except = [
                'addToCart/*',
                'api/*',
                'customer/login/apple/callback',
                'ebay/callbacks/*',
                'flutterwave/*',
                'paymentFailed/*',
                'payment/response/callback',
                'socialite/customer/apple/callback',
                '/build-twiml/*',
                'sslcommerz/*',
                'stripe/*',
                'wallet/sslcommerzdeposit',
        ];
}
