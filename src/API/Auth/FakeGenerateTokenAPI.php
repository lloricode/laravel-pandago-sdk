<?php

namespace Lloricode\LaravelPandagoSdk\API\Auth;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;

final class FakeGenerateTokenAPI extends GenerateTokenAPI
{
    public function fakeGenerate(?PromiseInterface $response = null): self
    {
        $response ??= Http::response(
            '{"access_token":"fake_token","expires_in":1234,"scope":"pandago.api.sg.*","token_type":"bearer"}'
        );

        Http::fake([$this->baseUrl.'/'.self::URL => $response]);

        return $this;
    }
}
