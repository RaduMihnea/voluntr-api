<?php

namespace App\Http\Controllers\Regions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Regions\IndexCityRequest;
use Domain\Regions\DTOs\CityData;
use Domain\Regions\Models\City;
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
