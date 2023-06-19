<?php

namespace Database\Factories;

use Domain\Badges\Models\BadgeProgress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BadgeProgress>
 */
class BadgeProgressFactory extends Factory
{
    protected $model = BadgeProgress::class;

    public function definition(): array
    {
        return [
            'volunteer_id' => fake()->countryCode(),
            'slug' => fake()->slug(),
            'progress' => fake()->numberBetween(1, 100),
        ];
    }
}
