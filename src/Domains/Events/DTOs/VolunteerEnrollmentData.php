<?php

namespace Domain\Events\DTOs;

use Domain\Events\Enums\EnrollmentStateEnum;
use Domain\Events\Models\Enrollment;
use Domain\Events\States\EnrollmentState;
use Illuminate\Support\Arr;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class VolunteerEnrollmentData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $organization,
        public string $date,
        #[DataCollectionOf(EventTypeData::class)]
        public DataCollection $eventTypes,
        public string $state,
        public ?int $eventId,
    ) {
    }

    public static function fromEnrollment(Enrollment $enrollment) {
        return new self(
            id: $enrollment->id,
            name: $enrollment->event?->name ?? $enrollment->event_name,
            organization: $enrollment->event?->organization->name ?? '',
            date: $enrollment->event?->starts_at ?? $enrollment->event_date,
            eventTypes: EventTypeData::collection($enrollment->event?->eventTypes ?? Arr::wrap($enrollment->eventType)),
            state: $enrollment->event ? $enrollment->state : EnrollmentStateEnum::APPROVED,
            eventId: $enrollment->event_id,
        );
    }
}
