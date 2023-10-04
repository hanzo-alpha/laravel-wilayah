<?php

namespace HanzoAlpha\LaravelWilayah\Commands;

use Illuminate\Console\Command;

class LaravelWilayahCommand extends Command
{
    public $signature = 'laravel-wilayah';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
