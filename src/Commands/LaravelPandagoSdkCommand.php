<?php

namespace Lloricode\LaravelPandagoSdk\Commands;

use Illuminate\Console\Command;

class LaravelPandagoSdkCommand extends Command
{
    public $signature = 'laravel-pandago-sdk';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
