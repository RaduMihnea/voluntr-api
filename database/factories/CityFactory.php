<?php

namespace Database\Factories;

use Domain\Organization\Models\Organization;
use Domain\Regions\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition(): array
    {
        return [
            'name' => fake()->city(),
            'country_id' => CountryFactory::new(),
        ];
    }

    public function bucharest(): array
    {
        return [
            'name' => 'București',
            'country_id' => CountryFactory::new()->romania(),
        ];
    }

    public function paris(): array
    {
        return [
            'name' => 'Paris',
            'country_id' => CountryFactory::new()->france(),
        ];
    }

    public function london(): array
    {
        return [
            'name' => 'London',
            'country_id' => CountryFactory::new()->england(),
        ];
    }
}
