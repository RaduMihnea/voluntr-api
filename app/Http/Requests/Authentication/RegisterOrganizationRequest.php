<?php

namespace App\Http\Requests\Authentication;

use Domain\Organization\DTOs\OrganizationData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class RegisterOrganizationRequest extends FormRequest
{
    use WithData;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:50', 'string'],
            'email' => ['required', 'email', 'unique:organizations,email'],
            'password' => ['required', 'min:6', 'max:255', 'string', 'confirmed'],
            'terms' => ['required', 'boolean', 'accepted'],
        ];
    }

    protected function dataClass(): string
    {
        return OrganizationData::class;
    }
}
