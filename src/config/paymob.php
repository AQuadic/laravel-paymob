<?php

return [
    'controller' => '\ctf0\PayMob\Controllers\DummyController',
    'accept'     => [
        'api_key'         => env('ACCEPT_API_KEY'),
        'merchant_id'     => env('ACCEPT_MERCHANT_ID'),
        'delivery_needed' => false,
        'conversion_rate' => 100, // cents
        'currency'        => 'EGP',
        'exp_after'       => 10, // seconds
        'min_amount'      => 5, // pounds
        'url'             => [
            'token'       => 'https://accept.paymob.com/api/auth/tokens',
            'order'       => 'https://accept.paymob.com/api/ecommerce/orders',
            'payment_key' => 'https://accept.paymob.com/api/acceptance/payment_keys',
            'refund'      => 'https://accept.paymob.com/api/acceptance/void_refund/refund',
            'hmac'        => env('ACCEPT_HMAC'),
        ],
        'payment_types' => [
            'card_payment' => [
                'url'            => 'https://accept.paymob.com/api/acceptance/iframes/' . env('ACCEPT_CARD_IFRAME_ID'),
                'integration_id' => env('ACCEPT_CARD_INTEGRATION_ID'),
            ],
            'mobile_wallet' => [
                'url'            => 'https://accept.paymob.com/api/acceptance/payments/pay',
                'integration_id' => env('ACCEPT_MW_INTEGRATION_ID'),
            ],
        ],
    ],
];
