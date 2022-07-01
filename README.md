# laravel-pandago-sdk

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lloricode/laravel-pandago-sdk.svg?style=flat-square)](https://packagist.org/packages/lloricode/laravel-pandago-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/lloricode/laravel-pandago-sdk/run-tests?label=tests)](https://github.com/lloricode/laravel-pandago-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/lloricode/laravel-pandago-sdk/Check%20&%20fix%20styling?label=code%20style)](https://github.com/lloricode/laravel-pandago-sdk/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/lloricode/laravel-pandago-sdk.svg?style=flat-square)](https://packagist.org/packages/lloricode/laravel-pandago-sdk)

https://pandago.docs.apiary.io

## Installation

You can install the package via composer:

```bash
composer require lloricode/laravel-pandago-sdk
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-pandago-sdk-config"
```

This is the contents of the published config file:

```php
<?php

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
        'expire_in_minutes' => env('PANDAGO_JWT_EXPIRE_IN_MINUTES', 1),
        'key_id' => env('PANDAGO_JWT_KEY_ID'),
        'jti' => env('PANDAGO_JWT_JTI'),
        'aud' => env('PANDAGO_JWT_AUD')
    ],

    'auth' => [
        'grant_type' => 'client_credentials',
        'client_id' => env('PANDAGO_CLIENT_ID'),
        'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
        'scope' => env('PANDAGO_SCOPE'),
    ],

    'retry' => 3,
];
```

## Usage

```php
# todo:
# see test suite for sample
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Lloric Mayuga Garcia](https://github.com/lloricode)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
