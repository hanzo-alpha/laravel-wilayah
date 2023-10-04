<?php

use HanzoAlpha\LaravelWilayah\LaravelWilayahApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(config('wilayah.api.middleware'))
    ->prefix(config('wilayah.api.route_prefix'))
    ->name(config('wilayah.api.route_name'))
    ->group(function () {
        //.
        Route::get('provinces', [LaravelWilayahApiController::class, 'provinces'])
            ->name('.provinces');

        Route::get('cities', [LaravelWilayahApiController::class, 'cities'])
            ->name('.cities');

        Route::get('districts', [LaravelWilayahApiController::class, 'districts'])
            ->name('.districts');

        Route::get('villages', [LaravelWilayahApiController::class, 'villages'])
            ->name('.villages');
        //.
    });
