<?php

namespace HanzoAlpha\LaravelWilayah;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use HanzoAlpha\LaravelWilayah\Commands\LaravelWilayahCommand;

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
            ->hasConfigFile('wilayah')
            ->hasViews()
            ->publishesServiceProvider('LaravelWilayah')
            ->hasMigration('create_wilayah_table')
            ->hasRoute('api')
            ->hasCommand(LaravelWilayahCommand::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command->publishConfigFile()
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('hanzo-alpha/laravel-wilayah');
            })
        ;
    }
}
