<?php

namespace App\Http\Requests\Shelf;

use Domain\Shelf\Models\Shelf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCollectibleRequest extends FormRequest
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
                'required',
                'integer',
                'numeric',
                'max:20'
            ],
            'description' => ['nullable','string'],
            'thumbnail' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
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
            'name' => __('common.name'),
            'number' => trans_choice('common.number', 1),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
            'user_id' => trans_choice('user.users', 1),
        ];
    }
}
