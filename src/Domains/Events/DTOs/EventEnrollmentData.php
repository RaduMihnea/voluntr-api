<?php

namespace Domain\Events\DTOs;

use Domain\Events\Models\Enrollment;
use Domain\Events\States\EnrollmentState;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EventEnrollmentData extends Data
{
    public function __construct(
        public int $id,
        public string $fullName,
        public string $slug,
        public string $phone,
        public string $summary,
        public string $age,
        public string $reputationLevel,
        public EnrollmentState $state,
    ) {
    }

    public static function fromEnrollment(Enrollment $enrollment) {
        return new self(
            id: $enrollment->id,
            fullName: $enrollment->volunteer->full_name,
            slug: $enrollment->volunteer->slug,
            phone: $enrollment->volunteer->phone,
            summary: $enrollment->volunteer->summary,
            age: $enrollment->volunteer->age,
            reputationLevel: $enrollment->volunteer->reputation_level,
            state: $enrollment->state,
        );
    }
}
