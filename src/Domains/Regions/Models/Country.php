<?php

namespace Domain\Regions\Models;

use Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'iso_code',
    ];

    public $timestamps = false;

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }
}
