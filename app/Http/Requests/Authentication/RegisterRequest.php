<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
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
}
