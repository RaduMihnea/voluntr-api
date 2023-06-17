<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class IndexEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filter.date_between' => [
                'sometimes',
                'array',
            ],
            'filter.date_between.*' => [
                'sometimes',
                'date',
            ],
            'filter.event_type' => [
                'sometimes',
                'array',
            ],
            'filter.event_type.*' => [
                'sometimes',
                'integer',
                'exists:event_types,id',
            ],
            'filter.min_age' => [
                'sometimes',
                'integer',
                'min:14',
            ],
            'filter.organization_id' => [
                'sometimes',
                'integer',
                'exists:organizations,id',
            ],
        ];
    }
}
