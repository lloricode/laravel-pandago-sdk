<?php

namespace Lloricode\LaravelPandagoSdk;

use Lloricode\LaravelPandagoSdk\API\Auth\FakeGenerateTokenAPI;
use Lloricode\LaravelPandagoSdk\API\Auth\GenerateTokenAPI;
use Lloricode\LaravelPandagoSdk\Commands\LaravelPandagoSdkCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPandagoSdkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-pandago-sdk')
            ->hasConfigFile()
            ->hasCommand(LaravelPandagoSdkCommand::class);
    }

    public function packageRegistered(): void
    {
        $mode = config('pandago-sdk.mode');

        $this->app->singleton(
            GenerateTokenAPI::class,
            fn() => new GenerateTokenAPI($mode)
        );

        $this->app->singleton(
            PandagoClient::class,
            fn() => new PandagoClient(
                app(
                    $mode === PandagoClient::ENVIRONMENT_TESTING
                        ? FakeGenerateTokenAPI::class
                        : GenerateTokenAPI::class
                ),
                $mode
            )
        );
    }
}
