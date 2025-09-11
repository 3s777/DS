<?php

namespace App\Admin\Http\Requests\Shelf;

use Domain\Shelf\Models\KitItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tests\RequestFactories\Shelf\Admin\CreateKitItemRequestFactory;

class CreateKitItemRequest extends FormRequest
{
    public static $factory = CreateKitItemRequestFactory::class;

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
                Rule::unique(KitItem::class)
            ],
            'user_id' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
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
