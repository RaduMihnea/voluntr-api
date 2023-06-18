<?php

namespace App\Http\Requests\Events;

use Domain\Volunteer\Models\Volunteer;
use Illuminate\Foundation\Http\FormRequest;

class DestroyEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() instanceof Volunteer
            && $this->route('enrollment')->volunteer_id === auth()->user()->id;
    }

    public function rules(): array
    {
        return [];
    }
}
