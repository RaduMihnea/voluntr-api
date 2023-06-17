<?php

namespace Domain\Events\DTOs;

use Domain\Events\Models\Event;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EventData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $slug,
        public string $description,
        public Carbon $startsAt,
        public Carbon $endsAt,
        public ?int $organizationId,
        public int $requiredVolunteersAmount,
        public int $minimumParticipantAge,
        public ?string $cover,
        #[DataCollectionOf(EventTypeData::class)]
        public ?DataCollection $eventTypes,
    ) {
    }

    public static function fromEvent(Event $event): self
    {
        return new self(
            id: $event->id,
            name: $event->name,
            slug: $event->slug,
            description: $event->description,
            startsAt: $event->starts_at,
            endsAt: $event->ends_at,
            organizationId: $event->organization_id,
            requiredVolunteersAmount: $event->required_volunteers_amount,
            minimumParticipantAge: $event->minimum_participant_age,
            cover: $event->cover,
            eventTypes: EventTypeData::collection($event->eventTypes),
        );
    }
}
