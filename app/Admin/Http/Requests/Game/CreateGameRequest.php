<?php

namespace App\Admin\Http\Requests\Game;

use Domain\Game\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tests\RequestFactories\Game\Admin\CreateGameRequestFactory;

class CreateGameRequest extends FormRequest
{
    public static $factory = CreateGameRequestFactory::class;

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
                Rule::unique(Game::class)
            ],
            'slug' => [
                'nullable',
                'max:250',
                'string', Rule::unique(Game::class)
            ],
            'description' => ['nullable','string'],
            'alternative_names' => ['nullable','string'],
            'released_at' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'genres' => [
                'nullable',
                'array',
                'exists:Domain\Game\Models\GameGenre,id'
            ],
            'platforms' => [
                'nullable',
                'array',
                'exists:Domain\Game\Models\GamePlatform,id'
            ],
            'developers' => [
                'nullable',
                'array',
                'exists:Domain\Game\Models\GameDeveloper,id'
            ],
            'publishers' => [
                'nullable',
                'array',
                'exists:Domain\Game\Models\GamePublisher,id'
            ],
            'user_id' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
            'images' => [
                'nullable',
                'max: 9'
            ],
            'images.*' => [
                'nullable',
                'mimes:jpg,png,jpeg',
                'max:10024'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'slug' => __('common.slug'),
            'description' => __('common.description'),
            'released_at' => __('game.released_at'),
            'alternative_names' => __('common.alternative_names'),
            'genres' => trans_choice('game.genre.genres', 2),
            'platforms' => trans_choice('game.platform.platforms', 2),
            'developers' => trans_choice('game.developer.developers', 2),
            'publishers' => trans_choice('game.publisher.publishers', 2),
            'featured_image' => __('common.featured_image'),
            'user_id' => trans_choice('user.users', 1),
            'images' => trans_choice('common.additional_image', 2)
        ];
    }
}
