<?php

namespace Domain\Authentication\DTOs;

use Domain\Authentication\Enums\RoleEnum;
use Domain\Organization\DTOs\OrganizationProfileData;
use Domain\Organization\Models\Organization;
use Domain\Volunteer\DTOs\VolunteerProfileData;
use Domain\Volunteer\Models\Volunteer;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $role,
        public string $token,
        public Data $profile,
    ) {
    }

    public static function fromOrganization(Organization $organization): self
    {
        return new self(
            id: $organization->id,
            role: RoleEnum::ORGANIZATION->value,
            token: $organization->createToken('Voluntr')->plainTextToken,
            profile: OrganizationProfileData::fromOrganization($organization)
        );
    }

    public static function fromVolunteer(Volunteer $volunteer): self
    {
        return new self(
            id: $volunteer->id,
            role: RoleEnum::VOLUNTEER->value,
            token: $volunteer->createToken('Voluntr')->plainTextToken,
            profile: VolunteerProfileData::fromVolunteer($volunteer)
        );
    }
}
