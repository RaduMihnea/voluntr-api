<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->id === $this->route('organization')->id;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'summary' => ['required', 'string', 'min:10', 'max:70'],
            'description' => ['required', 'string', 'min:10', 'max:500'],
        ];
    }
}
