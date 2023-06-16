<?php

namespace Domain\Events\DTOs;

use Domain\Events\Models\Event;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Support\Actions\CreateUniqueSlugAction;

#[MapName(SnakeCaseMapper::class)]
class EventCreateData extends Data
{
    public function __construct(
        public string $name,
        public ?string $slug,
        public string $description,
        public Carbon $startsAt,
        public Carbon $endsAt,
        public ?int $organizationId,
        public int $requiredVolunteersAmount,
        public int $minimumParticipantAge,
    ) {
        $this->organizationId = auth()->user()->id;
        $this->slug = app(CreateUniqueSlugAction::class)(model: Event::class, title: $this->name);
    }
}
