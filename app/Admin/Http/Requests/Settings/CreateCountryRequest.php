<?php

namespace App\Admin\Http\Requests\Settings;

use Domain\Shelf\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tests\RequestFactories\Settings\Admin\CreateCountryRequestFactory;

class CreateCountryRequest extends FormRequest
{
    public static $factory = CreateCountryRequestFactory::class;

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
                'string',
                'max:250'
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(Category::class)
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'slug' => __('common.slug'),
        ];
    }
}
