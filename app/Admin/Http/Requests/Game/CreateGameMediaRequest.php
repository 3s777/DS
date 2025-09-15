<?php

namespace App\Admin\Http\Requests\Game;

use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tests\RequestFactories\Admin\Game\CreateGameMediaRequestFactory;

class CreateGameMediaRequest extends FormRequest
{
    public static $factory = CreateGameMediaRequestFactory::class;

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
                Rule::unique(GameMedia::class)
            ],
            'variation_name' => [
                'max:250',
                Rule::unique(GameMediaVariation::class, 'name')
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(GameMedia::class)
            ],
            'article_number' => ['nullable','string'],
            'alternative_names' => ['nullable','string'],
            'barcodes' => ['nullable','string'],
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
            'games' => [
                'nullable',
                'array',
                'exists:Domain\Game\Models\Game,id'
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
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'variation_name' => __('collectible.variation.base_name'),
            'slug' => __('common.slug'),
            'article_number' => trans_choice('common.article_numbers', 1),
            'alternative_names' => __('common.alternative_names'),
            'barcodes' => trans_choice('common.barcodes', 2),
            'description' => __('common.description'),
            'released_at' => __('game.released_at'),
            'games' => __('game.games'),
            'genres' => trans_choice('game.genre.genres', 2),
            'platforms' => __('game.platform.platforms'),
            'developers' => __('game.developer.developers'),
            'publishers' => __('game.publisher.publishers'),
            'kit_items' => __('collectible.kit.items'),
            'featured_image' => __('common.featured_image'),
            'user_id' => trans_choice('user.users', 1),
            'images' => trans_choice('common.additional_image', 2)
        ];
    }
}
