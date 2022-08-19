<?php

namespace Lloricode\LaravelPandagoSdk;

use Lloricode\LaravelPandagoSdk\API\Auth\FakeGenerateTokenAPI;
use Lloricode\LaravelPandagoSdk\API\Auth\GenerateTokenAPI;
use Lloricode\LaravelPandagoSdk\Commands\GenerateKeyPairCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPandagoSdkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-pandago-sdk')
            ->hasConfigFile()
            ->hasCommand(GenerateKeyPairCommand::class);
    }

    public function packageRegistered(): void
    {
        $mode = (string) config('pandago-sdk.mode');

        $generateTokeApi = $mode === PandagoClient::ENVIRONMENT_TESTING
            ? FakeGenerateTokenAPI::class
            : GenerateTokenAPI::class;

        $this->app->singleton(
            $generateTokeApi,
            fn () => new $generateTokeApi($mode)
        );

        $this->app->singleton(
            PandagoClient::class,
            fn () => new PandagoClient(app($generateTokeApi), $mode)
        );
    }
}
