<?php

declare(strict_types=1);

namespace HanzoAlpha\LaravelWilayah\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Island extends Model
{
    use HasRelationships;

    public $timestamps = false;
    protected $primaryKey = 'island_code';
    protected $fillable = ['island_code', 'province_code', 'city_code', 'name'];

    public function __construct(array $attributes = [])
    {
        if (empty($this->table)) {
            $this->setTable(config('wilayah.table_prefix') . 'islands');
        }

        parent::__construct($attributes);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_code');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_code');
    }

    public function district(): HasOneThrough
    {
        return $this->hasOneThrough(
            District::class,
            City::class,
            'city_code',
            'city_code',
            'city_code',
            'city_code'
        );
    }

    public function villages(): HasManyThrough
    {
        return $this->hasManyThrough(Village::class, City::class);
    }
}
