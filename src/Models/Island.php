<?php
declare(strict_types=1);

namespace HanzoAlpha\LaravelWilayah\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class Island extends Model
{
    protected $primaryKey = 'island_code';
    public $timestamps = false;
    protected $fillable = ['island_code', 'province_code', 'city_code', 'name'];

    public function __construct(array $attributes = [])
    {
        if (empty($this->table)) {
            $this->setTable(config('wilayah.table_prefix') . 'islands');
        }

        parent::__construct($attributes);
    }

    public function province(): HasManyDeep
    {
        return $this->hasManyDeep(Province::class);
    }
}
