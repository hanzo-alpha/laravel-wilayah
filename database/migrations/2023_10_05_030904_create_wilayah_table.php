<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(config('wilayah.table_prefix') . 'cities', static function (Blueprint $table) {
            $table->char('city_code', 4)->primary();
            $table->char('province_code', 2);
            $table->string('name', 255);
            $table->foreign('province_code')
                ->references('province_code')
                ->on(config('wilayah.table_prefix') . 'provinces')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create(config('wilayah.table_prefix') . 'districts', static function (Blueprint $table) {
            $table->char('district_code', 7)->primary();
            $table->char('city_code', 4);
            $table->string('name', 255);
            $table->foreign('city_code')
                ->references('city_code')
                ->on(config('wilayah.table_prefix') . 'cities')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create(config('wilayah.table_prefix') . 'villages', static function (Blueprint $table) {
            $table->char('village_code', 10)->primary();
            $table->char('district_code', 7);
            $table->string('name', 255);
            $table->foreign('district_code')
                ->references('district_code')
                ->on(config('wilayah.table_prefix') . 'districts')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create(config('wilayah.table_prefix') . 'islands', static function (Blueprint $table) {
            $table->char('island_code', 5)->primary();
            $table->char('province_code', 2);
            $table->char('city_code', 4);
            $table->string('name', 255);
            $table->foreign('province_code')
                ->references('province_code')
                ->on(config('wilayah.table_prefix') . 'provinces')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('city_code')
                ->references('city_code')
                ->on(config('wilayah.table_prefix') . 'cities')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }
};
