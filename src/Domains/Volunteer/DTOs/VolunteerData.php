<?php

namespace Domain\Volunteer\DTOs;

use Domain\Volunteer\Models\Volunteer;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Support\Actions\CreateUniqueSlugAction;

#[MapName(SnakeCaseMapper::class)]
class VolunteerData extends Data
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public ?string $slug,
        public string $email,
        public string $password,
    ) {
        $this->slug ??= app(CreateUniqueSlugAction::class)(
            model: Volunteer::class,
            title: "$lastName $firstName"
        );
        $this->password = Hash::make($password);
    }
}
