<?php

namespace Database\Factories;

use Domain\Events\Enums\EnrollmentStateEnum;
use Domain\Events\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    protected $model = Enrollment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => EventFactory::new(),
            'volunteer_id' => VolunteerFactory::new(),
            'state' => fake()->randomElement([
                EnrollmentStateEnum::APPROVED,
                EnrollmentStateEnum::PENDING,
                EnrollmentStateEnum::REJECTED,
            ]),
        ];
    }

    public function pending(): self
    {
        return $this->state([
            'state' => EnrollmentStateEnum::PENDING,
        ]);
    }

    public function approved(): self
    {
        return $this->state([
            'state' => EnrollmentStateEnum::APPROVED,
        ]);
    }

    public function rejected(): self
    {
        return $this->state([
            'state' => EnrollmentStateEnum::REJECTED,
        ]);
    }
}
