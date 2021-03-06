<?php

namespace Lloricode\LaravelPandagoSdk\API;

use Lloricode\LaravelPandagoSdk\PandagoClient;

abstract class BaseAPI
{
    protected PandagoClient $pandagoClient;

    abstract protected function url(): string;

    public function __construct(PandagoClient $pandagoClient)
    {
        $this->pandagoClient = $pandagoClient;
    }

    /** @return static */
    public static function new(): self
    {
        return app(static::class);
    }

    abstract public static function fake(): self;
}
