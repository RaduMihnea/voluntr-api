<?php

namespace Database\Factories;

use Domain\Events\Models\EventType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EventType>
 */
class EventTypeFactory extends Factory
{
    protected $model = EventType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'translation_slug' => fake()->slug(),
            'color' => fake()->hexColor(),
        ];
    }
}
