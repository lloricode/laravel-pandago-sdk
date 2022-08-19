<?php

namespace Lloricode\LaravelPandagoSdk\Commands;

use Illuminate\Console\Command;
use Lloricode\LaravelPandagoSdk\Facades\LaravelPandagoSdk;

class GenerateKeyPairCommand extends Command
{
    public $signature = 'pandago-sdk:generate:key-pair';

    public $description = 'My command';

    public function handle(): int
    {
        $success = LaravelPandagoSdk::token()->generateKeyPair();

        $this->comment('Generating key pairs....');

        if ($success) {
            $this->info('Generated: ' . LaravelPandagoSdk::token()->privateKeyFileName());
            $this->info('Generated: ' . LaravelPandagoSdk::token()->publicKeyFileName());

            $this->info('Key pair saved!');
        }
        else {
            $this->error('Failed to generate key pair.');
        }

        return $success ? self::SUCCESS : self::FAILURE;
    }
}
