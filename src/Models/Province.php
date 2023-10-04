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

    protected $primaryKey = 'province_code';
    public $timestamps = false;

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
        return $this->hasMany(City::class);
    }

    public function districts(): HasManyThrough
    {
        return $this->hasManyThrough(District::class, City::class);
    }

    public function villages(): HasManyDeep
    {
        return $this->hasManyDeep(Village::class, [City::class, District::class]);
    }

    public function islands(): HasManyDeep
    {
        return $this->hasManyDeep(Island::class, [self::class, City::class]);
    }
}
