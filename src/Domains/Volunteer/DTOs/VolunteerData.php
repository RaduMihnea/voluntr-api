<?php

namespace Domain\Volunteer\DTOs;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class VolunteerData extends Data
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
    ) {
        $this->password = Hash::make($password);
    }
}
