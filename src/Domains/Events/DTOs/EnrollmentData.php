<?php

namespace Domain\Events\DTOs;

use Domain\Events\Models\Enrollment;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EnrollmentData extends Data
{
    public function __construct(
        public string $avatar,
        public string $initials,
    ) {
    }

    public static function fromEnrollment(Enrollment $enrollment): self
    {
        return new self(
            avatar: $enrollment->volunteer->avatar,
            initials: Str::ucfirst($enrollment->volunteer->first_name[0] . $enrollment->volunteer->last_name[0]),
        );
    }
}
