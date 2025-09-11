<?php

namespace App\Admin\Http\Requests\Shelf;

use Domain\Game\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShelfRequest extends FormRequest
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
                Rule::unique(Game::class)->ignore($this->game)
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
            'featured_image_selected' => ['nullable', 'bool'],
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
            'user_id' => trans_choice('user.users', 1),
        ];
    }
}
