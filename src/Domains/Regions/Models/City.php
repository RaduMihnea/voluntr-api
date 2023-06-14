<?php

namespace Domain\Regions\Models;

use Database\Factories\CityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
    ];

    public $timestamps = false;

    protected static function newFactory(): CityFactory
    {
        return CityFactory::new();
    }
}
