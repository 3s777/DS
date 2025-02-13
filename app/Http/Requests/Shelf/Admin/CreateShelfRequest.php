<?php

namespace App\Http\Requests\Shelf\Admin;

use Domain\Shelf\Models\Shelf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateShelfRequest extends FormRequest
{
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
            'name' => [
                'required',
                'max:250',
                Rule::unique(Shelf::class)
            ],
            'number' => [
                'nullable',
                'integer',
                'numeric',
                'max:100000'
            ],
            'description' => ['nullable','string'],
            'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'collector_id' => [
                'required',
                'integer',
                'exists:Domain\Auth\Models\Collector,id'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'number' => trans_choice('common.numbers', 1),
            'description' => __('common.description'),
            'featured_image' => __('common.featured_image'),
            'collector_id' => trans_choice('user.collectors', 1),
        ];
    }
}
