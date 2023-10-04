<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(config('wilayah.table_prefix') . 'provinces', static function (Blueprint $table) {
            $table->char('code', 2)->primary();
            $table->string('name', 255);
        });

        Schema::create(config('wilayah.table_prefix') . 'cities', static function (Blueprint $table) {
            $table->char('code', 4)->primary();
            $table->char('province_code', 2);
            $table->string('name', 255);
            $table->foreign('province_code')
                ->references('code')
                ->on(config('wilayah.table_prefix') . 'provinces')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create(config('wilayah.table_prefix') . 'districts', static function (Blueprint $table) {
            $table->char('code', 7)->primary();
            $table->char('city_code', 4);
            $table->string('name', 255);
            $table->foreign('city_code')
                ->references('code')
                ->on(config('wilayah.table_prefix') . 'cities')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create(config('wilayah.table_prefix') . 'villages', static function (Blueprint $table) {
            $table->char('code', 10)->primary();
            $table->char('district_code', 7);
            $table->string('name', 255);
            $table->string('postal_code')->nullable();
            $table->foreign('district_code')
                ->references('code')
                ->on(config('wilayah.table_prefix') . 'districts')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }
};
