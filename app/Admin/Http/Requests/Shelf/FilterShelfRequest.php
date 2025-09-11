<?php

namespace App\Admin\Http\Requests\Shelf;

use Illuminate\Foundation\Http\FormRequest;

class FilterShelfRequest extends FormRequest
{
    protected $redirectRoute = 'admin.shelves.index';

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
            'filters.search' => [
                'nullable',
                'string',
                'max:250'
            ],
            'filters.dates.from' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.dates.to' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.collector' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\Collector,id'
            ],
        ];
    }

    public function messages()
    {
        return [
            'filters.dates.from' => __('validation.filters_date'),
            'filters.dates.to' => __('validation.filters_date'),
        ];
    }

    public function attributes()
    {
        return [
            'filters.search' => __('common.search'),
            'filters.dates' => __('common.dates'),
            'filters.collector' => trans_choice('user.collectors', 1),
        ];
    }
}
