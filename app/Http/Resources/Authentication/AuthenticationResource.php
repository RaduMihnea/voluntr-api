<?php

namespace App\Http\Resources\Authentication;

use App\Http\Resources\VolunteerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class AuthenticationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->createToken('Voluntr')->plainTextToken,
            'user' => new VolunteerResource($this),
        ];
    }
}
