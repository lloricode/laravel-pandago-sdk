<?php
// config for Lloricode/LaravelPandagoSdk
return [

    'url' => [
        'auth' => [
            'production' => env('PANDAGO_URL_AUTH_PRODUCTION', 'https://sts.deliveryhero.io'),
            'sandbox' => env('PANDAGO_URL_AUTH_SANDBOX', 'https://sts-st.deliveryhero.io'),
        ],
        'base' => [
            'production' => env('PANDAGO_URL_BASE_PRODUCTION', 'https://sts.deliveryhero.io'),
            'sandbox' => env('PANDAGO_URL_BASE_SANDBOX', 'https://pandago-api-sandbox.deliveryhero.io'),
        ]
    ],

    'mode' => env('PANDAGO_MODE', Lloricode\LaravelPandagoSdk\PandagoClient::ENVIRONMENT_SANDBOX),

    'country_code' => env('PANDAGO_COUNTRY_CODE', 'sg'), // must be `sg` when in sandbox mode

    'jwt' => [
        'key_id' => env('PANDAGO_KEY_ID'),
        'jti' => env('PANDAGO_JTI'),
        'exp' => env('PANDAGO_EXP'),
        'aud' => env('PANDAGO_AUD')
    ],

    'auth' => [
        'grant_type' => 'client_credentials',
        'client_id' => env('PANDAGO_CLIENT_ID'),
        'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
        'scope' => env('PANDAGO_SCOPE'),
    ],

    'retry' => 3,
];
