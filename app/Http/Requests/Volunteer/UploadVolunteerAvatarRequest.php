<?php

namespace App\Http\Requests\Volunteer;

use Illuminate\Foundation\Http\FormRequest;

class UploadVolunteerAvatarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->id === $this->route('volunteer')->id;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'image'],
        ];
    }
}
