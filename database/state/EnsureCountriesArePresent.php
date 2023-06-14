<?php

namespace Database\State;

use Domain\Regions\Models\Country;
use Illuminate\Support\Facades\DB;

class EnsureCountriesArePresent
{
    public function __invoke(): void
    {
        if ($this->present()) {
            return;
        }

        $countriesJson = file_get_contents(database_path('state/data/countries.json'));
        $countries = json_decode($countriesJson, true);

        DB::table('countries')->insert($countries);
    }

    public function present(): bool
    {
        return Country::count() > 0;
    }
}
