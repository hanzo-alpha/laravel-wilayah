<?php
declare(strict_types=1);

namespace HanzoAlpha\LaravelWilayah;

use HanzoAlpha\LaravelWilayah\Models\City;
use HanzoAlpha\LaravelWilayah\Models\District;
use HanzoAlpha\LaravelWilayah\Models\Island;
use HanzoAlpha\LaravelWilayah\Models\Province;
use HanzoAlpha\LaravelWilayah\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;

class LaravelWilayahDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('> Start wilayah seeder...');

        $startTime = microtime(true);

        Schema::disableForeignKeyConstraints();

        $this->seedProvinces();
        $this->seedCities();
        $this->seedDistricts();
        $this->seedVillages();
        $this->seedIslands();

        Schema::enableForeignKeyConstraints();

        $endTime = round(microtime(true) - $startTime, 2);

        $this->command->info("> ✔ OK: Took {$endTime} seconds.");
    }

    protected function seedIslands(): void
    {
        Island::truncate();
        $content = file_get_contents(__DIR__ . '/..database/raw/islands.csv');
        $data = $this->csvToArray(gzdecode($content));
        Island::insert($this->mapIslandsData($data));
    }

    protected function mapIslandsData(array $data): array
    {
        return array_map(static function ($item) {
            return [
                'island_code' => $item[1],
                'province_code' => $item[2],
                'city_code' => $item[3],
                'name' => $item[4],
            ];
        }, $data);
    }

    protected function seedProvinces(): void
    {
        Province::truncate();

        $content = file_get_contents(__DIR__ . '/../database/raw/provinces.csv');

        $data = $this->csvToArray(gzdecode($content));

        Province::insert($this->mapProvincesData($data));
    }

    protected function mapProvincesData(array $data): array
    {
        return array_map(static function ($item) {
            return [
                'province_code' => $item[1],
                'name' => $item[2],
            ];
        }, $data);
    }

    protected function seedCities(): void
    {
        City::truncate();

        $content = file_get_contents(__DIR__ . '/../database/raw/cities.csv');

        $data = $this->csvToArray(gzdecode($content));

        City::insert($this->mapCitiesData($data));
    }

    protected function mapCitiesData(array $data): array
    {
        return array_map(static function ($item) {
            return [
                'city_code' => $item[1],
                'province_code' => $item[2],
                'name' => $item[3],
            ];
        }, $data);
    }

    protected function seedDistricts(): void
    {
        District::truncate();

        $content = file_get_contents(__DIR__ . '/../database/raw/districts.csv');

        $data = $this->csvToArray(gzdecode($content));

        District::insert($this->mapDistrictsData($data));
    }

    protected function mapDistrictsData(array $data): array
    {
        return array_map(static function ($item) {
            return [
                'district_code' => $item[1],
                'city_code' => $item[2],
                'name' => $item[3],
            ];
        }, $data);
    }

    protected function seedVillages(): void
    {
        Village::truncate();

        $path = __DIR__ . '/../database/raw/villages.csv';

        $files = array_diff(scandir($path), ['.', '..']);

        foreach ($files as $file) {
            $content = file_get_contents($path . '/' . $file);

            $data = $this->csvToArray(gzdecode($content));

            Village::insert($this->mapVillagesData($data));
        }
    }

    protected function mapVillagesData(array $data): array
    {
        return array_map(static function ($item) {
            return [
                'district_code' => $item[1],
                'village_code' => $item[2],
                'name' => $item[3],
            ];
        }, $data);
    }

    protected function csvToArray(string $content): array
    {
        $data = [];

        foreach (explode("\n", $content) as $item) {
            if (!empty($item)) {
                $data[] = str_getcsv($item);
            }
        }

        return $data;
    }
}
