<?php

namespace App\Http\Requests\Game;

use Domain\Game\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateGameRequest extends FormRequest
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
            'name' => ['required', Rule::unique(Game::class)],
            'slug' => [
                'nullable',
                'string', Rule::unique(Game::class)
            ],
            'description' => ['nullable','string'],
            'released_at' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'thumbnail' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'genres' => [
                'required',
                'array',
                'exists:Domain\Game\Models\GameGenre,id'
            ],
            'platforms' => [
                'nullable',
                'array',
                'exists:Domain\Game\Models\GamePlatform,id'
            ],
            'developers' => [
                'required',
                'array',
                'exists:Domain\Game\Models\GameDeveloper,id'
            ],
            'publishers' => [
                'nullable',
                'array',
                'exists:Domain\Game\Models\GamePublisher,id'
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('common.name'),
            'slug' => __('common.slug'),
            'description' => __('common.description'),
            'released_at' => __('game.released_at'),
            'genres' => __('game_genre.genres'),
            'platforms' => __('game_platform.platforms'),
            'developers' => __('game_developer.developers'),
            'publishers' => __('game_publisher.publishers'),
            'thumbnail' => __('common.thumbnail'),
            'user_id' => __('user.user'),
        ];
    }
}
