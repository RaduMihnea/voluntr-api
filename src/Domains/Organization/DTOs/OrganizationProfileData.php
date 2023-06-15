<?php

namespace Domain\Organization\DTOs;

use Domain\Organization\Models\Organization;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrganizationProfileData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public ?int $cityId,
        public ?int $countryId,
        public ?string $summary,
        public ?string $description,
        public ?string $avatar,
    ) {
    }

    public static function fromOrganization(Organization $organization): self
    {
        return new self(
            id: $organization->id,
            name: $organization->name,
            email: $organization->email,
            cityId: $organization->city_id,
            countryId: $organization->city?->country_id,
            summary: $organization->summary,
            description: $organization->description,
            avatar: $organization->avatar,
        );
    }
}
