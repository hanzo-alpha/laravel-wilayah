<?php

namespace HanzoAlpha\LaravelWilayah;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
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
            ->hasConfigFile('wilayah')
            ->publishesServiceProvider('LaravelWilayah')
            ->hasMigration('create_laravel_wilayah_table')
            ->hasRoute('api')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command->publishConfigFile()
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('hanzo-alpha/laravel-wilayah');
            });
    }
}
