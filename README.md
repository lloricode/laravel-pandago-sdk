# laravel-pandago-sdk

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lloricode/laravel-pandago-sdk.svg?style=flat-square)](https://packagist.org/packages/lloricode/laravel-pandago-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/lloricode/laravel-pandago-sdk/run-tests?label=tests)](https://github.com/lloricode/laravel-pandago-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/lloricode/laravel-pandago-sdk/Check%20&%20fix%20styling?label=code%20style)](https://github.com/lloricode/laravel-pandago-sdk/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/lloricode/laravel-pandago-sdk.svg?style=flat-square)](https://packagist.org/packages/lloricode/laravel-pandago-sdk)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

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
return [
    'mode' => env('PANDAGO_MODE', Lloricode\LaravelPandagoSdk\PandagoClient::ENVIRONMENT_SANDBOX),

    'auth' => [
        'grant_type' => 'client_credentials',
        'client_id' => env('PANDAGO_CLIENT_ID'),
        'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
        'client_assertion' => env('PANDAGO_CLIENT_ASSERTION'),
        'scope' => env('PANDAGO_SCOPE'),
    ],

    'retry' => 3,
];
```

## Usage

```php
# todo:
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
