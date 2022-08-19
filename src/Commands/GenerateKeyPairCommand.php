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

        $this->comment('All done');

        return $success ? self::SUCCESS : self::FAILURE;
    }
}
