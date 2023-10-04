<?php

namespace HanzoAlpha\LaravelWilayah;

use HanzoAlpha\LaravelWilayah\Commands\LaravelWilayahCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelWilayahServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-wilayah')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-wilayah_table')
            ->hasCommand(LaravelWilayahCommand::class);
    }
}
