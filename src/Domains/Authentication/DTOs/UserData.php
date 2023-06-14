<?php

namespace Domain\Authentication\DTOs;

use Domain\Authentication\Enums\RoleEnum;
use Domain\Organization\Models\Organization;
use Domain\Volunteer\Models\Volunteer;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $role,
        public string $token,
    ) {
    }

    public static function fromOrganization(Organization $organization): self
    {
        return new self(
            id: $organization->id,
            name: $organization->name,
            email: $organization->email,
            role: RoleEnum::ORGANIZATION->value,
            token: $organization->createToken('Voluntr')->plainTextToken
        );
    }

    public static function fromVolunteer(Volunteer $volunteer): self
    {
        return new self(
            id: $volunteer->id,
            name: "{$volunteer->first_name} {$volunteer->last_name}",
            email: $volunteer->email,
            role: RoleEnum::VOLUNTEER->value,
            token: $volunteer->createToken('Voluntr')->plainTextToken
        );
    }
}
