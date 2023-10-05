<?php
declare(strict_types=1);

namespace HanzoAlpha\LaravelWilayah\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Staudenmeir\EloquentHasManyDeep\HasOneDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Village extends Model
{
    use HasRelationships;

    protected $primaryKey = 'village_code';

    public $timestamps = false;

    protected $fillable = ['village_code', 'district_code', 'name'];

    public function __construct(array $attributes = [])
    {
        if (empty($this->table)) {
            $this->setTable(config('wilayah.table_prefix') . 'villages');
        }

        parent::__construct($attributes);
    }

    public function province(): HasOneDeep
    {
        return $this->hasOneDeep(
            Province::class,
            [District::class, City::class],
            ['province_code', 'district_code', 'city_code'],
            ['district_code', 'city_code', 'province_code'],
        );
    }

    public function city(): HasOneThrough
    {
        return $this->hasOneThrough(
            City::class,
            District::class,
            'city_code',
            'district_code',
            'district_code',
            'city_code'
        );
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function islands(): HasOneThrough
    {
        return $this->hasOneThrough(
            Island::class,
            City::class,
            'island_code',
            'city_code',
            'city_code',
            'island_code'
        );
    }
}
