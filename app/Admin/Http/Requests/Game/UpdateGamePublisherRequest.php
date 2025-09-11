<?php

namespace App\Admin\Http\Requests\Game;

use Domain\Game\Models\GamePublisher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGamePublisherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    //    public function prepareForValidation()
    //    {
    //        $this->merge([
    //            'slug' => Str::slug($this->slug)
    //        ]);
    //    }

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
                Rule::unique(GamePublisher::class)->ignore($this->game_publisher)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(GamePublisher::class)->ignore($this->game_publisher)
            ],
            'description' => ['nullable','string'],
            'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'featured_image_selected' => ['nullable', 'bool'],
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
            'description' => __('common.description'),
            'featured_image' => __('common.featured_image'),
            'user_id' => trans_choice('user.users', 1),
        ];
    }
}
