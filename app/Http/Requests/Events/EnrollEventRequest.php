<?php

namespace App\Http\Requests\Events;

use Domain\Organization\Models\Organization;
use Domain\Volunteer\Models\Volunteer;
use Illuminate\Foundation\Http\FormRequest;

class EnrollEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() instanceof Volunteer;
    }

    public function rules(): array
    {
        return [];
    }
}
