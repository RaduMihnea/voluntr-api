<?php

namespace Domain\Regions\DTOs;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CityData extends Data
{
    public function __construct(
        #[MapInputName('id')]
        public int $value,
        #[MapInputName('name')]
        public string $label,
        public int $countryId,
    ) {
    }
}
