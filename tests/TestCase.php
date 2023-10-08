<?php

namespace HanzoAlpha\LaravelWilayah\Tests;

use HanzoAlpha\LaravelWilayah\LaravelWilayahServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use DatabaseTransactions;

    //    protected function setUp(): void
    //    {
    //        parent::setUp();
    //
    //        Factory::guessFactoryNamesUsing(
    //            static fn (string $modelName) => 'HanzoAlpha\\LaravelWilayah\\Database\\Factories\\'.class_basename($modelName).'Factory'
    //        );
    //    }

    //    protected function setUp(): void
    //    {
    //        parent::setUp();
    //        Artisan::call('migrate');
    //        Artisan::call('db:seed', [
    //            'class' => \HanzoAlpha\LaravelWilayah\LaravelWilayahDatabaseSeeder::class,
    //        ]);
    //        die(0); // disable DatabaseTransaction first
    //    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('database.connections.testing', [
            'driver' => 'mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => 'BlackID85',
            //            'prefix' => config()->get('wilayah.table_prefix'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'database' => 'laravel_wilayah',
        ]);

        //        Artisan::call('migrate');
        //        Artisan::call('db:seed', [
        //            'class' => \HanzoAlpha\LaravelWilayah\LaravelWilayahDatabaseSeeder::class,
        //        ]);

        /* $migration = include __DIR__ . '/../database/migrations/create_laravel-wilayah_table.php.stub';
         $migration->up();*/

    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelWilayahServiceProvider::class,
        ];
    }
}
