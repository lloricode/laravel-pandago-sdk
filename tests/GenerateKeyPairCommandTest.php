<?php

use Lloricode\LaravelPandagoSdk\API\Auth\GenerateTokenAPI;
use Lloricode\LaravelPandagoSdk\Commands\GenerateKeyPairCommand;
use Lloricode\LaravelPandagoSdk\Facades\LaravelPandagoSdk;
use Lloricode\LaravelPandagoSdk\PandagoClient;

use function Pest\Laravel\artisan;
use function PHPUnit\Framework\assertFileDoesNotExist;
use function PHPUnit\Framework\assertFileExists;

it('generate key pair', function () {
    config([
        'pandago-sdk.mode' => PandagoClient::ENVIRONMENT_SANDBOX,
        'pandago-sdk.key_pair_path' => base_path(),
    ]);

    LaravelPandagoSdk::token()->deleteKeyPair();

    $privateKey = base_path(PandagoClient::ENVIRONMENT_SANDBOX.'-'.GenerateTokenAPI::PRIVATE_KEY);
    $publicKey = base_path(PandagoClient::ENVIRONMENT_SANDBOX.'-'.GenerateTokenAPI::PUBLIC_KEY);

    assertFileDoesNotExist($privateKey);
    assertFileDoesNotExist($publicKey);

    artisan(GenerateKeyPairCommand::class)
        ->expectsOutput('Generating key pairs....')
        ->expectsOutput('Generated: '.$privateKey)
        ->expectsOutput('Generated: '.$publicKey)
        ->expectsOutput('Key pair saved!')
        ->assertSuccessful();

    assertFileExists($privateKey);
    assertFileExists($publicKey);


    LaravelPandagoSdk::token()->deleteKeyPair();
});
