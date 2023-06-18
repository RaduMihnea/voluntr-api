<?php

namespace App\Http\Requests\Events;

use Domain\Organization\Models\Organization;
use Domain\Volunteer\Models\Volunteer;
use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() instanceof Volunteer;
    }

    public function rules(): array
    {
        return [
            'event_name' => [
                'required',
                'string',
                'min:5',
                'max:70',
            ],
            'event_description' => [
                'required',
                'string',
                'min:10',
                'max:500',
            ],
            'event_date' => [
                'required',
                'date',
                'before:today',
            ],
            'event_type_id' => [
                'required',
                'integer',
                'exists:event_types,id',
            ],
        ];
    }
}
