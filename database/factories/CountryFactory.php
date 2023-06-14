<?php

namespace Database\Factories;

use Domain\Regions\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Country>
 */
class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'name' => fake()->country(),
            'code' => fake()->countryCode(),
            'iso_code' => fake()->countryISOAlpha3(),
        ];
    }

    public function romania(): array
    {
        return [
            'name' => 'Romania',
            'code' => 'RO',
            'iso_code' => 'ROU',
        ];
    }

    public function france(): array
    {
        return [
            'name' => 'France',
            'code' => 'FR',
            'iso_code' => 'FRA',
        ];
    }

    public function england(): array
    {
        return [
            'name' => 'England',
            'code' => 'EN',
            'iso_code' => 'ENG',
        ];
    }
}
