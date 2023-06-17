<?php

namespace Database\Factories;

use Domain\Events\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
            'starts_at' => now(),
            'ends_at' => now()->addHour(),
            'organization_id' => OrganizationFactory::new(),
            'required_volunteers_amount' => fake()->numberBetween(1, 10),
            'minimum_participant_age' => fake()->numberBetween(14, 100),
        ];
    }
}
