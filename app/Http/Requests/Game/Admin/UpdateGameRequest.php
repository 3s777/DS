<?php

namespace App\Http\Requests\Game\Admin;

use Domain\Game\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGameRequest extends FormRequest
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
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(Game::class)->ignore($this->game)
            ],
            'description' => ['nullable','string'],
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
            'featured_image_selected' => ['nullable', 'bool'],
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
            ],
            'images' => [
                'nullable',
                'max: 9'
            ],
            'images.*' => [
                'nullable',
                'mimes:jpg,png,jpeg',
                'max:10024'
            ],
            'images_delete' => [
                'nullable'
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
            'genres' => trans_choice('game_genre.genres', 2),
            'platforms' => trans_choice('game_platform.platforms', 2),
            'developers' => trans_choice('game_developer.developers', 2),
            'publishers' => trans_choice('game_publisher.publishers', 2),
            'featured_image' => __('common.featured_image'),
            'images' => trans_choice('common.additional_image', 2),
            'user_id' => trans_choice('user.users', 1),
        ];
    }
}
