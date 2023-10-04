<?php
declare(strict_types=1);

namespace HanzoAlpha\LaravelWilayah\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class District extends Model
{

    protected $primaryKey = 'disctrict_code';

    public $timestamps = false;

    protected $fillable = [
        'district_code',
        'city_code',
        'name'
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
            'code',
            'code',
            'city_code',
            'province_code',
        );
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class);
    }
}
