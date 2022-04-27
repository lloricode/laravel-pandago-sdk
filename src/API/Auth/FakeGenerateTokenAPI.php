<?php

namespace Lloricode\LaravelPandagoSdk\API\Auth;

use ErrorException;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Lloricode\LaravelPandagoSdk\DTO\Auth\Token;
use Lloricode\LaravelPandagoSdk\PandagoClient;

class FakeGenerateTokenAPI extends GenerateTokenAPI
{

    public function fake(?PromiseInterface $response = null): self
    {
        $response ??= Http::response(
            '{"access_token":"fake_token","expires_in":1234}'
        );

        Http::fake([$this->baseUrl.'/'.self::URL => $response]);

        return $this;
    }
}