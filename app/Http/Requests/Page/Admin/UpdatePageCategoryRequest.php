<?php

namespace App\Http\Requests\Page\Admin;

use Domain\Page\Models\PageCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageCategoryRequest extends FormRequest
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
                'string',
                'max:250'
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(PageCategory::class)->ignore($this->page_category)
            ],
            'description' => ['nullable','string'],
            'user_id' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
            'parent_id' => [
                'nullable',
                'integer',
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
            'user_id' => trans_choice('user.users', 1),
            'parent_id' => __('page.category.parent'),
        ];
    }
}
