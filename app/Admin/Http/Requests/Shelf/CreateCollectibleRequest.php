<?php

namespace App\Admin\Http\Requests\Shelf;

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
            'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
            'shelf_id' => ['required'],
            'condition' => ['required'],
            'shelf2_id' => ['required'],
            'user_idm' => ['required'],
            'shelf-async.test' => ['required']
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'number' => trans_choice('common.number', 1),
            'description' => __('common.description'),
            'featured_image' => __('common.featured_image'),
            'user_id' => trans_choice('user.users', 1),
        ];
    }
}
