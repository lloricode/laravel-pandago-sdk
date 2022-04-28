<?php

namespace Lloricode\LaravelPandagoSdk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin  \Lloricode\LaravelPandagoSdk\LaravelPandagoSdk
 */
class LaravelPandagoSdk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Lloricode\LaravelPandagoSdk\LaravelPandagoSdk::class;
    }
}
