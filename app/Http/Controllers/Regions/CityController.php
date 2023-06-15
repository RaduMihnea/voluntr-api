<?php

namespace App\Http\Controllers\Regions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Regions\IndexCityRequest;
use App\Http\Requests\Volunteer\ShowVolunteerRequest;
use App\Http\Requests\Volunteer\UpdateVolunteerRequest;
use Domain\Regions\DTOs\CityData;
use Domain\Regions\DTOs\CountryData;
use Domain\Regions\Models\City;
use Domain\Regions\Models\Country;
use Domain\Volunteer\DTOs\VolunteerProfileData;
use Domain\Volunteer\Models\Volunteer;
use Spatie\LaravelData\DataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class CityController extends Controller
{
    public function index(IndexCityRequest $request): DataCollection
    {
        $cities = QueryBuilder::for(City::class)
            ->allowedFilters(['country_id'])
            ->defaultSort('name')
            ->get();

        return CityData::collection($cities);
    }
}
