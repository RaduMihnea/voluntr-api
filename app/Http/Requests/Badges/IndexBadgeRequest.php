<?php

namespace App\Http\Requests\Badges;

use Domain\Volunteer\Models\Volunteer;
use Illuminate\Foundation\Http\FormRequest;

class IndexBadgeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() instanceof Volunteer;
    }

    public function rules(): array
    {
        return [];
    }
}
