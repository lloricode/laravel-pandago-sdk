<?php
// config for Lloricode/LaravelPandagoSdk
return [

    'mode' => env('PANDAGO_MODE', Lloricode\LaravelPandagoSdk\PandagoClient::ENVIRONMENT_SANDBOX),

    'country_code' => env('PANDAGO_COUNTRY_CODE', 'sg'), // must be `sg` when in sandbox mode

    'auth' => [
        'grant_type' => 'client_credentials',
        'client_id' => env('PANDAGO_CLIENT_ID'),
        'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
        'client_assertion' => env('PANDAGO_CLIENT_ASSERTION'),
        'scope' => env('PANDAGO_SCOPE'),
    ],

//    'cache_key' => '__pandago_cache_key',

    'retry' => 3,
];
