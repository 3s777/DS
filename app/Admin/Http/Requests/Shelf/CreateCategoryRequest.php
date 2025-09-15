<?php

namespace App\Admin\Http\Requests\Shelf;

use Domain\Shelf\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tests\RequestFactories\Admin\Shelf\CreateCategoryRequestFactory;

class CreateCategoryRequest extends FormRequest
{
    public static $factory = CreateCategoryRequestFactory::class;

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
            'model' => [
                'required',
                'string',
                'max:250',
                Rule::in(array_keys(config('settings.collectables'))),
                Rule::unique(Category::class)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(Category::class)
            ],
            'description' => ['nullable','string'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'slug' => __('common.slug'),
            'description' => __('common.description')
        ];
    }
}
