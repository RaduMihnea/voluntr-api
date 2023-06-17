<?php

namespace Domain\Events\DTOs;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EventTypeData extends Data
{
    public function __construct(
        public int $id,
        public string $translationSlug,
        public string $color,
    ) {
    }
}
