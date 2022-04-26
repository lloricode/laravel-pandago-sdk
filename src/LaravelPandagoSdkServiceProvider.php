<?php

namespace Lloricode\LaravelPandagoSdk;

use Lloricode\LaravelPandagoSdk\Commands\LaravelPandagoSdkCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPandagoSdkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-pandago-sdk')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-pandago-sdk_table')
            ->hasCommand(LaravelPandagoSdkCommand::class);
    }
}
