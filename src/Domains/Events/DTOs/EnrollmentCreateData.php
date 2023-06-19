<?php

namespace Domain\Events\DTOs;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EnrollmentCreateData extends Data
{
    public function __construct(
        public string $eventName,
        public string $eventDescription,
        public Carbon $eventDate,
        public int $eventTypeId,
        public ?int $volunteerId,
    ) {
        $this->volunteerId = auth()->user()->id;
    }
}
