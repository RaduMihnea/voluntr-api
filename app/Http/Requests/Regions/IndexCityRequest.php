<?php

namespace App\Http\Requests\Regions;

use Illuminate\Foundation\Http\FormRequest;

class IndexCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filter.country_id' => [
                'required',
                'exists:countries,id'
            ],
        ];
    }
}
