<?php

namespace App\Http\Requests\Events;

use Domain\Events\States\EnrollmentState;
use Domain\Organization\Models\Organization;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\ModelStates\Validation\ValidStateRule;

class EnrollmentChangeStateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() instanceof Organization
            && $this->route('enrollment')->event->organization_id === auth()->user()->id;
    }

    public function rules(): array
    {
        return [
            'state' => [
                'required',
                new ValidStateRule(EnrollmentState::class),
            ]
        ];
    }
}
