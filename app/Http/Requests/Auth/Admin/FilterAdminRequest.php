<?php

namespace App\Http\Requests\Auth\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FilterAdminRequest extends FormRequest
{
    protected $redirectRoute = 'admin.users.index';

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'filters.search' => ['nullable', 'string'],
            'filters.dates.from' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.dates.to' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'filters.dates.from' => __('validation.filters_date'),
            'filters.dates.to' => __('validation.filters_date'),
        ];
    }

    public function attributes(): array
    {
        return [
            'filters.search' => __('common.search'),
            'filters.dates' => __('common.dates'),
        ];
    }
}
