<?php

namespace Lloricode\LaravelPandagoSdk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lloricode\LaravelPandagoSdk\LaravelPandagoSdk
 */
class LaravelPandagoSdk extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-pandago-sdk';
    }
}
