<?php

namespace Domain\Volunteer\DTOs;

use Domain\Volunteer\Models\Volunteer;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class VolunteerProfileData extends Data
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
        public string $slug,
        public string $email,
        public ?string $phone,
        public ?Carbon $birthday,
        public ?int $cityId,
        public ?int $countryId,
        public ?string $summary,
        public ?string $description,
        public ?string $avatar,
    ) {
    }

    public static function fromVolunteer(Volunteer $volunteer): self
    {
        return new self(
            id: $volunteer->id,
            firstName: $volunteer->first_name,
            lastName: $volunteer->last_name,
            slug: $volunteer->slug,
            email: $volunteer->email,
            phone: $volunteer->phone,
            birthday: $volunteer->birthday,
            cityId: $volunteer->city_id,
            countryId: $volunteer->city?->country_id,
            summary: $volunteer->summary,
            description: $volunteer->description,
            avatar: $volunteer->avatar,
        );
    }
}
