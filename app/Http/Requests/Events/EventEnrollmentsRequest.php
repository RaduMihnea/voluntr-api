<?php

namespace App\Http\Requests\Events;

use Domain\Organization\Models\Organization;
use Illuminate\Foundation\Http\FormRequest;

class EventEnrollmentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() instanceof Organization
            && $this->route('event')->organization_id === auth()->user()->id;
    }

    public function rules(): array
    {
        return [];
    }
}
