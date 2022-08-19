<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Lloricode\LaravelPandagoSdk\Facades\LaravelPandagoSdk;

use function Pest\Faker\faker;

it('generate token', function () {
    $accessToken = faker()->word;
    $expiresInSeconds = Arr::random(range(1_000, 2_000, 10));

    $apiResponse = LaravelPandagoSdk::token()->fake()
        ->fakeGenerate(
            Http::response(
                <<<FAKE
{"access_token":"$accessToken","expires_in":$expiresInSeconds,"scope":"pandago.api.sg.*","token_type":"bearer"}
FAKE
            )
        )
        ->generate();

    expect($apiResponse)
        ->access_token->toBe($accessToken)
        ->expires_in->toBe($expiresInSeconds);
});
