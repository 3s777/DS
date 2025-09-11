<?php

namespace App\Admin\Http\Requests\Game;

use Domain\Game\Models\GamePublisher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tests\RequestFactories\Game\Admin\CreateGamePublisherRequestFactory;

class CreateGamePublisherRequest extends FormRequest
{
    public static $factory = CreateGamePublisherRequestFactory::class;

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
                Rule::unique(GamePublisher::class)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(GamePublisher::class)
            ],
            'description' => ['nullable','string'],
            'featured_image' => [
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
            'name' => trans_choice('common.name', 1),
            'slug' => __('common.slug'),
            'description' => __('common.description'),
            'featured_image' => __('common.featured_image'),
            'user_id' => trans_choice('user.users', 1),
        ];
    }
}
