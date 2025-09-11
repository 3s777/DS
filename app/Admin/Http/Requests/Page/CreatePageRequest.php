<?php

namespace App\Admin\Http\Requests\Page;

use Domain\Page\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tests\RequestFactories\Page\Admin\CreatePageRequestFactory;

class CreatePageRequest extends FormRequest
{
    public static $factory = CreatePageRequestFactory::class;

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
                Rule::unique(Page::class)
            ],
            'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'description' => ['nullable','string'],
            'user_id' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
            'categories' => [
                'required',
                'array',
                'exists:Domain\Page\Models\PageCategory,id'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'slug' => __('common.slug'),
            'description' => __('common.description'),
            'featured_image' => __('common.featured_image'),
            'user_id' => trans_choice('user.users', 1),
            'categories' => trans_choice('page.category.categories', 2)
        ];
    }
}
