<?php

use HanzoAlpha\LaravelWilayah\Models\City;
use HanzoAlpha\LaravelWilayah\Models\District;
use HanzoAlpha\LaravelWilayah\Models\Island;
use HanzoAlpha\LaravelWilayah\Models\Province;
use HanzoAlpha\LaravelWilayah\Models\Village;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;

//uses(TestCase::class);

it('can set table_prefix config', function () {
    expect((new Province)->getTable())->toBe('wilayah_provinces');

    Config::set('wilayah.table_prefix', '');
    expect((new Province)->getTable())
        ->toBe('provinces')
        ->not->toBe('wilayah_provinces');

    Config::set('wilayah.table_prefix', 'wilayah_');
    expect((new City)->getTable())->toBe('wilayah_cities');

    Config::set('wilayah.table_prefix', 'indo_');
    expect((new City)->getTable())
        ->toBe('indo_cities')
        ->not->toBe('wilayah_cities');

    Config::set('wilayah.table_prefix', 'wilayah_');
    expect((new District)->getTable())->toBe('wilayah_districts');

    Config::set('wilayah.table_prefix', 'master_');
    expect((new District)->getTable())
        ->toBe('master_districts')
        ->not->toBe('wilayah_districts');

    Config::set('wilayah.table_prefix', 'master_');
    expect((new Island)->getTable())
        ->toBe('master_islands')
        ->not->toBe('wilayah_islands');

    Config::set('wilayah.table_prefix', 'wilayah_');
    expect((new Island)->getTable())->toBe('wilayah_islands');

    Config::set('wilayah.table_prefix', 'idn_');
    expect((new Island)->getTable())
        ->toBe('idn_islands')
        ->not->toBe('wilayah_islands');
});

it('can get a province', function () {
    expect(Province::first())->not->toBeEmpty();

    $province = Province::find(33);
    expect($province->province_code)->toBe(33)
        ->and($province->name)->toBe('JAWA TENGAH');
});

it('can get province model relations', function () {
    $cities = Province::find(33)->cities;

    expect($cities)->toBeInstanceOf(Collection::class)
        ->and($cities->count())->toBe(35)
        ->and($cities->first()->city_code)->toBe(3301)
        ->and($cities->first()->name)->toBe('KAB. CILACAP')
        ->and($cities->last()->city_code)->toBe(3376)
        ->and($cities->last()->name)->toBe('KOTA TEGAL');

    $districts = Province::find(33)->districts;
    expect($districts)->toBeInstanceOf(Collection::class)
        ->and($districts->count())->toBe(576)
        ->and($districts->first()->district_code)->toBe(330101)
        ->and($districts->first()->name)->toBe('Kedungreja')
        ->and($districts->last()->district_code)->toBe(337604)
        ->and($districts->last()->name)->toBe('Margadana');

    $villlages = Province::find(33)->villages;
    expect($villlages)->toBeInstanceOf(Collection::class)
        ->and($villlages->count())->toBe(8563)
        ->and($villlages->first()->village_code)->toBe(3301012001)
        ->and($villlages->first()->name)->toBe('Tambakreja')
        ->and($villlages->last()->village_code)->toBe(3376041007)
        ->and($villlages->last()->name)->toBe('Pesurungan Lor');

    $islands = Province::find(33)->islands;
    expect($islands)->toBeInstanceOf(Collection::class)
        ->and($islands->count())->toBe(71)
        ->and($islands->first()->island_code)->toBe(40001)
        ->and($islands->first()->name)->toBe('Nusa Bagian')
        ->and($islands->last()->island_code)->toBe(40032)
        ->and($islands->last()->name)->toBe('Pulau Tengah');
});

it('can get a city', function () {
    expect(City::first())->not->toBeEmpty();

    $city = City::find(3374);
    expect($city->city_code)->toBe(3374)
        ->and($city->name)->toBe('KOTA SEMARANG');
});

it('can get city model relations', function () {
    $province = City::find(3374)->province;
    expect($province)->toBeInstanceOf(Province::class)
        ->and($province->province_code)->toBe(33)
        ->and($province->name)->toBe('JAWA TENGAH');

    $districts = City::find(3374)->districts;
    expect($districts)->toBeInstanceOf(Collection::class)
        ->and($districts->count())->toBe(16)
        ->and($districts->first()->district_code)->toBe(337401)
        ->and($districts->first()->name)->toBe('Semarang Tengah')
        ->and($districts->last()->district_code)->toBe(337416)
        ->and($districts->last()->name)->toBe('Tugu');

    $cities = City::find(3374)->villages;
    expect($cities)->toBeInstanceOf(Collection::class)
        ->and($cities->count())->toBe(177)
        ->and($cities->first()->village_code)->toBe(3374011001)
        ->and($cities->first()->name)->toBe('Miroto')
        ->and($cities->last()->village_code)->toBe(3374161007)
        ->and($cities->last()->name)->toBe('Mangunharjo');

    $islands = City::find(1504)->islands;
    expect($islands)->toBeInstanceOf(Collection::class)
        ->and($islands->count())->toBe(2)
        ->and($islands->first()->island_code)->toBe(40001)
        ->and($islands->first()->name)->toBe('Pulau Selat')
        ->and($islands->last()->island_code)->toBe(40002)
        ->and($islands->last()->name)->toBe('Pulau Senaning');
});

it('can get a district', function () {
    expect(District::first())->not->toBeEmpty();
    $district = District::find(337401);
    expect($district->district_code)->toBe(337401)
        ->and($district->name)->toBe('Semarang Tengah');
});

it('can get district model relations', function () {
    $province = District::find(337401)->province;
    expect($province)->toBeInstanceOf(Province::class)
        ->and($province->province_code)->toBe(33)
        ->and($province->name)->toBe('JAWA TENGAH');

    $city = District::find(337401)->city;
    expect($city)->toBeInstanceOf(City::class)
        ->and($city->city_code)->toBe(3374)
        ->and($city->name)->toBe('KOTA SEMARANG');

    $villlages = District::find(337401)->villages;
    expect($villlages)->toBeInstanceOf(Collection::class)
        ->and($villlages->count())->toBe(15)
        ->and($villlages->first()->village_code)->toBe(3374011001)
        ->and($villlages->first()->name)->toBe('Miroto')
        ->and($villlages->last()->village_code)->toBe(3374011015)
        ->and($villlages->last()->name)->toBe('Pindrikan Lor');
});

it('can get a village', function () {
    expect(Village::first())->not->toBeEmpty();

    $village = Village::find(3374011001);
    expect($village->village_code)->toBe(3374011001)
        ->and($village->name)->toBe('Miroto');
});

it('can get village model relations', function () {
    $province = Village::find(3374011001)->province;
    expect($province)->toBeInstanceOf(Province::class)
        ->and($province->province_code)->toBe(33)
        ->and($province->name)->toBe('JAWA TENGAH');

    $city = Village::find(3374011001)->city;
    expect($city)->toBeInstanceOf(City::class)
        ->and($city->city_code)->toBe(3374)
        ->and($city->name)->toBe('KOTA SEMARANG');

    $district = Village::find(3374011001)->district;
    expect($district)->toBeInstanceOf(District::class)
        ->and($district->district_code)->toBe(337401)
        ->and($district->name)->toBe('Semarang Tengah');
});

it('can get a island', function () {
    expect(Island::first())->not->toBeEmpty();

    $province = Island::find(40020);
    expect($province->island_code)->toBe(40020)
        ->and($province->name)->toBe('Pulau Burok');
});

it('can get island model relations', function () {
    $province = Island::find(40020)->province;
    expect($province)->toBeInstanceOf(Province::class)
        ->and($province->province_code)->toBe(11)
        ->and($province->name)->toBe('ACEH');

    $city = Island::find(40020)->city;
    expect($city)->toBeInstanceOf(City::class)
        ->and($city->city_code)->toBe(1106)
        ->and($city->name)->toBe('KAB. ACEH BESAR');

    $district = Island::find(40020)->district;
    //    dd($district);
    expect($district)->toBeInstanceOf(District::class)
        ->and($district->district_code)->toBe(110601)
        ->and($district->name)->toBe('Lhoong');
});

it('can get new districts added in v2', function () {
    $district = District::find(110115);
    expect($district->district_code)->toBe(110115)
        ->and($district->name)->toBe('Bakongan Timur');

    $district = District::find(930423);
    expect($district->district_code)->toBe(930423)
        ->and($district->name)->toBe('Koroway Buluanop');
});

it('can get new villages added in v2', function () {
    $village = Village::find(1207212002);
    expect($village->village_code)->toBe(1207212002)
        ->and($village->name)->toBe('Patumbak I');

    $village = Village::find(9201502009);
    expect($village->village_code)->toBe(9201502009)
        ->and($village->name)->toBe('Mlaron');
});

it('can test new data for v2.0.2', function () {
    $district = District::find(331710);
    expect($district->district_code)->toBe(331710)
        ->and($district->name)->toBe('Rembang');
});
