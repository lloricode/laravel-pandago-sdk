<?php

use Lloricode\LaravelPandagoSdk\Commands\GenerateKeyPairCommand;

use function Pest\Laravel\artisan;

it('generate key pair', function () {
    artisan(GenerateKeyPairCommand::class)
        ->assertSuccessful();
});
