<?php

namespace App\Http\Requests\Game;

use Domain\Game\Models\GameMedia;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGameMediaRequest extends FormRequest
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
                Rule::unique(GameMedia::class)->ignore($this->game_media)
            ],
            'slug' => [
                'nullable',
                'string',
                Rule::unique(GameMedia::class)->ignore($this->game_media)
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
            'thumbnail_selected' => ['nullable', 'string'],
            'genres' => [
                'nullable',
                'array',
                'exists:game_genres,id'
            ],
            'platforms' => [
                'nullable',
                'array',
                'exists:game_platforms,id'
            ],
            'developers' => [
                'nullable',
                'array',
                'exists:game_developers,id'
            ],
            'publishers' => [
                'nullable',
                'array',
                'exists:game_publishers,id'
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