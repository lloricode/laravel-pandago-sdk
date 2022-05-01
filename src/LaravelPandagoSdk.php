<?php

namespace Lloricode\LaravelPandagoSdk;

use Lloricode\LaravelPandagoSdk\API\Auth\GenerateTokenAPI;
use Lloricode\LaravelPandagoSdk\API\Order\OrderAPI;

class LaravelPandagoSdk
{
    public static function enabled(): bool
    {
        return config('pandago-sdk.enabled');
    }

    public static function token(): GenerateTokenAPI
    {
        return GenerateTokenAPI::new();
    }

    public static function order(): OrderAPI
    {
        return OrderAPI::new();
    }
}
