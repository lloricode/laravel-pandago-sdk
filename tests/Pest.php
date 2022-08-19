<?php

use Lloricode\LaravelPandagoSdk\Facades\LaravelPandagoSdk;
use Lloricode\LaravelPandagoSdk\Tests\TestCase;

uses(TestCase::class)
    ->beforeEach(function () {
//        Http::fake(); // Http::preventStrayRequests(); // TODO: use Http::preventStrayRequests() after upgrading to laravel 9

        LaravelPandagoSdk::token()->fake()->generateKeyPair();
    })
    ->afterEach(function () {
        LaravelPandagoSdk::token()->fake()->deleteKeyPair();
    })
    ->in(__DIR__);
