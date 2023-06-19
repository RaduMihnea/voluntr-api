<?php

namespace Domain\Organization\DTOs;

use Domain\Organization\Models\Organization;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Support\Actions\CreateUniqueSlugAction;

#[MapName(SnakeCaseMapper::class)]
class OrganizationData extends Data
{
    public function __construct(
        public string $name,
        public ?string $slug,
        public string $email,
        public string $password,
    ) {
        $this->slug ??= app(CreateUniqueSlugAction::class)(model: Organization::class, title: $name);
        $this->password = Hash::make($password);
    }
}
