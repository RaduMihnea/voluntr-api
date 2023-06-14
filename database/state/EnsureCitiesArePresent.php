<?php

namespace Database\State;

use Domain\Regions\Models\City;
use Domain\Regions\Models\Country;
use Illuminate\Support\Facades\DB;

class EnsureCitiesArePresent
{
    public function __invoke(): void
    {
        if ($this->present()) {
            return;
        }

        $countries = ['france' => 'fr', 'romania' => 'ro', 'uk' => 'gb'];

        foreach ($countries as $country => $isoCode) {
            $json = file_get_contents(database_path("state/data/cities_$country.json"));
            $cities = json_decode($json, true);

            $countryId = Country::where('iso_code', $isoCode)->first()->id;

            $cities = array_map(function ($city) use ($countryId) {
                return [
                    'name' => $city['city'],
                    'country_id' => $countryId,
                ];
            }, $cities);

            DB::table('cities')->insert($cities);
        }
    }


    public function present(): bool
    {
        return City::count() > 0;
    }
}
