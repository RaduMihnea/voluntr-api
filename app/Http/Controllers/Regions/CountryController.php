<?php

namespace App\Http\Controllers\Regions;

use App\Http\Controllers\Controller;
use Domain\Regions\DTOs\CountryData;
use Domain\Regions\Models\Country;
use Spatie\LaravelData\DataCollection;

class CountryController extends Controller
{
    public function index(): DataCollection
    {
        return CountryData::collection(Country::all());
    }
}
