<?php

namespace App\Http\Requests\Authentication;

use Domain\Volunteer\DTOs\VolunteerData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class RegisterVolunteerRequest extends FormRequest
{
    use WithData;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'min:3', 'max:50', 'string'],
            'last_name' => ['required', 'min:3', 'max:50', 'string'],
            'email' => ['required', 'email', 'unique:volunteers,email'],
            'password' => ['required', 'min:6', 'max:255', 'string'],
            'terms' => ['required', 'boolean', 'accepted'],
        ];
    }

    protected function dataClass(): string
    {
        return VolunteerData::class;
    }
}
