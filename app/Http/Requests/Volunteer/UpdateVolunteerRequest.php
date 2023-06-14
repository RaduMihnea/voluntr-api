<?php

namespace App\Http\Requests\Volunteer;

use Domain\Volunteer\DTOs\VolunteerProfileData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class UpdateVolunteerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->id === $this->route('volunteer')->id;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['required', 'string', 'min:8', 'max:255'],
            'birthday' => ['required', 'date', 'before:today'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'summary' => ['required', 'string', 'min:10', 'max:70'],
            'description' => ['required', 'string', 'min:10', 'max:500'],
        ];
    }
}
