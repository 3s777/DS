<?php

namespace App\Http\Requests\Game;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterGameDeveloperRequest extends FormRequest
{
    protected $redirectRoute = 'game-developers.index';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'filters.search' => ['nullable', 'date'],
            'filters.dates.from' => ['nullable', 'date', 'date_format:Y-m-d'],
            'filters.dates.to' => ['nullable', 'date', 'date_format:Y-m-d'],
        ];
    }

    public function messages()
    {
        return [
            'filters.dates.from' => __('validation.filters_date'),
            'filters.dates.to' => __('validation.filters_date'),
        ];
    }
}
