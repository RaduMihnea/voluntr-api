<?php

namespace App\Http\Resources;

use Domain\Volunteer\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Volunteer */
class VolunteerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
        ];
    }
}
