<?php

namespace Domain\Badges\DTOs;

use Domain\Badges\Models\Badge;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class BadgeData extends Data
{
    public function __construct(
        public string $name,
        public string $icon,
        public string $requiredCompletionAmount,
        public string $awardedPoints,
        public string $progress,
        public bool $isCompleted = false,
    ) {
    }

    public static function fromBadge(Badge $badge): self
    {
        return new self(
            name: $badge->name,
            icon: $badge->icon,
            requiredCompletionAmount: $badge->required_completion_amount,
            awardedPoints: $badge->awarded_points,
            progress: $badge->progress,
            isCompleted: $badge->isCompleted,
        );
    }
}
