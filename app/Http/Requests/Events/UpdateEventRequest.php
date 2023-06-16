<?php

namespace App\Http\Requests\Events;

use Domain\Organization\Models\Organization;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() instanceof Organization
            && $this->route('event')->organization_id === auth()->user()->id;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:70',
            ],
            'description' => [
                'required',
                'string',
                'min:10',
                'max:500',
            ],
            'starts_at' => [
                'required',
                'date',
                'after:today',
                'before:ends_at',
            ],
            'ends_at' => [
                'required',
                'date',
                'after:starts_at',
            ],
            'required_volunteers_amount' => [
                'required',
                'integer',
                'min:1',
            ],
            'minimum_participant_age' => [
                'required',
                'integer',
                'min:14',
                'max:100',
            ],
            'type_ids' => [
                'required',
                'array',
                'min:1',
            ],
            'type_ids.*' => [
                'required',
                'integer',
                'exists:event_types,id',
            ],
            'image' => [
                'required',
                'image',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(json_decode($this->payload, true, 512, JSON_THROW_ON_ERROR));
    }
}
