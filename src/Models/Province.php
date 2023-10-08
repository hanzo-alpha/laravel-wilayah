<?php

declare(strict_types=1);

namespace HanzoAlpha\LaravelWilayah\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Province extends Model
{
    use HasRelationships;

    public $timestamps = false;
    protected $primaryKey = 'province_code';
    protected $fillable = ['province_code', 'name'];

    public function __construct(array $attributes = [])
    {
        if (empty($this->table)) {
            $this->setTable(config('wilayah.table_prefix') . 'provinces');
        }

        parent::__construct($attributes);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'province_code', 'province_code',);
    }

    public function districts(): HasManyThrough
    {
        return $this->hasManyThrough(District::class, City::class, 'province_code', 'city_code');
    }

    public function villages(): HasManyDeep
    {
        return $this->hasManyDeep(
            Village::class,
            [City::class, District::class],
            ['province_code', 'city_code', 'district_code'],
//            ['city_code', 'district_code', 'province_code']
        );
    }

    public function islands(): HasMany
    {
        return $this->hasMany(Island::class, 'province_code', 'province_code');
    }
}
