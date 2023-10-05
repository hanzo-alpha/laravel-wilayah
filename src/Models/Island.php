<?php

declare(strict_types=1);

namespace HanzoAlpha\LaravelWilayah\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Island extends Model
{
    use HasRelationships;

    protected $primaryKey = 'island_code';

    public $timestamps = false;

    protected $fillable = ['island_code', 'province_code', 'city_code', 'name'];

    public function __construct(array $attributes = [])
    {
        if (empty($this->table)) {
            $this->setTable(config('wilayah.table_prefix').'islands');
        }

        parent::__construct($attributes);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function districts(): HasManyDeep
    {
        return $this->hasManyDeep(District::class, [Province::class, City::class]);
    }

    public function villages(): HasManyThrough
    {
        return $this->hasManyThrough(Village::class, City::class);
    }
}
