<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class UploadOrganizationAvatarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->id === $this->route('organization')->id;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'image'],
        ];
    }
}
