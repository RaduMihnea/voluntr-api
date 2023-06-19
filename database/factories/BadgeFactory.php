<?php

namespace Database\Factories;

use Domain\Badges\Models\Badge;
use Domain\Badges\Models\BadgeProgress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Badge>
 */
class BadgeFactory extends Factory
{
    protected $model = Badge::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'icon' => fake()->word(),
            'badge_progress_id' => BadgeProgress::factory(),
            'required_completion_amount' => fake()->numberBetween(1, 100),
            'awarded_points' => fake()->numberBetween(50, 1000),
        ];
    }
}
