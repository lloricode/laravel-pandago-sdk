# laravel-pandago-sdk

[![Latest Stable Version](http://poser.pugx.org/lloricode/laravel-pandago-sdk/v)](https://packagist.org/packages/lloricode/laravel-pandago-sdk) [![Total Downloads](http://poser.pugx.org/lloricode/laravel-pandago-sdk/downloads)](https://packagist.org/packages/lloricode/laravel-pandago-sdk) [![Latest Unstable Version](http://poser.pugx.org/lloricode/laravel-pandago-sdk/v/unstable)](https://packagist.org/packages/lloricode/laravel-pandago-sdk) [![License](http://poser.pugx.org/lloricode/laravel-pandago-sdk/license)](https://packagist.org/packages/lloricode/laravel-pandago-sdk) [![PHP Version Require](http://poser.pugx.org/lloricode/laravel-pandago-sdk/require/php)](https://packagist.org/packages/lloricode/laravel-pandago-sdk)

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
// config for Lloricode/LaravelPandagoSdk
use Illuminate\Support\Str;

return [
    'url' => [
        'auth' => [
            'production' => env('PANDAGO_URL_AUTH_PRODUCTION', 'https://sts.deliveryhero.io'),
            'sandbox' => env('PANDAGO_URL_AUTH_SANDBOX', 'https://sts-st.deliveryhero.io'),
        ],
        'base' => [
            'production' => env('PANDAGO_URL_BASE_PRODUCTION', 'https://pandago-api-apse.deliveryhero.io'),
            'sandbox' => env('PANDAGO_URL_BASE_SANDBOX', 'https://pandago-api-sandbox.deliveryhero.io'),
        ]
    ],

    'mode' => env('PANDAGO_MODE', Lloricode\LaravelPandagoSdk\PandagoClient::ENVIRONMENT_SANDBOX),

    'country_code' => env('PANDAGO_COUNTRY_CODE', 'sg'), // must be `sg` when in sandbox mode

    'jwt' => [
        'expire_in_minutes' => env('PANDAGO_JWT_EXPIRE_IN_MINUTES', 1),
        'key_id' => env('PANDAGO_JWT_KEY_ID'),
        'jti' => env('PANDAGO_JWT_JTI', (string) Str::uuid()),
        'aud' => env('PANDAGO_JWT_AUD')
    ],

    'auth' => [
        'grant_type' => 'client_credentials',
        'client_id' => env('PANDAGO_CLIENT_ID'),
        'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
        'scope' => env('PANDAGO_SCOPE'),
    ],

    'key_pair_path' => env('PANDAGO_KEY_PAIR_PATH', storage_path()),

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
