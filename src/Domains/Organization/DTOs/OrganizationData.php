<?php

namespace Domain\Organization\DTOs;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrganizationData extends Data
{
    public function __construct(
        public string $name,
        public ?string $slug,
        public string $email,
        public string $password,
    ) {
        $this->slug ??= Str::slug($name);
        $this->password = Hash::make($password);
    }
}
