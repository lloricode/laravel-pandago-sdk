<?php

use Illuminate\Support\Facades\Http;
use Lloricode\LaravelPandagoSdk\API\Auth\GenerateTokenAPI;

use function Pest\Faker\faker;

it('generate token', function () {
    $accessToken = faker()->word;
    $expiresInSeconds = faker()->randomDigitNotZero();

    $token = GenerateTokenAPI::newFake(
        Http::response(
            <<<FAKE
{"access_token":"$accessToken","expires_in":$expiresInSeconds}
FAKE
        )
    )
        ->token();

    expect($token)
        ->access_token->toBe($accessToken)
        ->expires_in->toBe($expiresInSeconds);
});
