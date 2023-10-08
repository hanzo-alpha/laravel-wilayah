<?php

declare(strict_types=1);

namespace HanzoAlpha\LaravelWilayah\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class District extends Model
{
//    use HasRelationships;

    public $timestamps = false;
    protected $primaryKey = 'district_code';
    protected $fillable = [
        'district_code',
        'city_code',
        'name',
    ];

    public function __construct(array $attributes = [])
    {
        if (empty($this->table)) {
            $this->setTable(config('wilayah.table_prefix') . 'districts');
        }

        parent::__construct($attributes);
    }

    public function province(): HasOneThrough
    {
        return $this->hasOneThrough(
            Province::class,
            City::class,
            'city_code',
            'province_code',
            'city_code',
            'province_code',

        );
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_code', 'city_code');
    }

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'district_code', 'district_code');
    }

    public function island(): HasOneThrough
    {
        return $this->hasOneThrough(
            Province::class,
            City::class,
            'city_code',
            'province_code',
            'city_code',
            'province_code',

        );
    }
}
