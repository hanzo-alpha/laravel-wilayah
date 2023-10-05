<?php

namespace HanzoAlpha\LaravelWilayah\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HanzoAlpha\LaravelWilayah\LaravelWilayah
 */
class LaravelWilayah extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HanzoAlpha\LaravelWilayah\LaravelWilayah::class;
    }
}
