<?php

namespace App\Http\Requests\Game\Admin;

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
                'max:250',
                Rule::unique(GameMedia::class)->ignore($this->game_media)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(GameMedia::class)->ignore($this->game_media)
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
            'games' => [
                'nullable',
                'array',
                'exists:games,id'
            ],
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
                'array',
                'exists:game_publishers,id'
            ],
            'kit_items' => [
                'required',
                'array',
                'exists:Domain\Shelf\Models\KitItem,id'
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
            'games' => __('game.games'),
            'genres' => __('game_genre.genres'),
            'platforms' => __('game_platform.platforms'),
            'developers' => __('game_developer.developers'),
            'publishers' => __('game_publisher.publishers'),
            'featured_image' => __('common.featured_image'),
            'user_id' => trans_choice('user.users', 1),
            'images' => trans_choice('common.additional_image', 2)
        ];
    }
}
