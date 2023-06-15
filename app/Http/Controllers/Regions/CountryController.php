<?php

namespace App\Http\Controllers\Regions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Volunteer\ShowVolunteerRequest;
use App\Http\Requests\Volunteer\UpdateVolunteerRequest;
use Domain\Regions\DTOs\CountryData;
use Domain\Regions\Models\Country;
use Domain\Volunteer\DTOs\VolunteerProfileData;
use Domain\Volunteer\Models\Volunteer;
use Spatie\LaravelData\DataCollection;

class CountryController extends Controller
{
    public function index(): DataCollection
    {
        return CountryData::collection(Country::all());
    }
}
