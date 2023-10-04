<?php
declare(strict_types=1);

namespace HanzoAlpha\LaravelWilayah\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'district_code',
        'city_code',
        'name'
    ];
}
