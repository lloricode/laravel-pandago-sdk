<?php

namespace Lloricode\LaravelPandagoSdk\API;

use Lloricode\LaravelPandagoSdk\PandagoClient;

abstract class BaseAPI
{
    protected PandagoClient $pandagoClient;

    public function __construct(PandagoClient $pandagoClient)
    {
        $this->pandagoClient = $pandagoClient;
    }

    /** @return static */
    public static function new(): self
    {
        return app(static::class);
    }
}