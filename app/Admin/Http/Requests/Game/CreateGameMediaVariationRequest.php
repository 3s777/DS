<?php

namespace App\Admin\Http\Requests\Game;

use Domain\Game\Models\GameMedia;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tests\RequestFactories\Game\Admin\CreateGameDeveloperRequestFactory;
use Tests\RequestFactories\Game\Admin\CreateGameMediaVariationRequestFactory;

class CreateGameMediaVariationRequest extends FormRequest
{
    public static $factory = CreateGameMediaVariationRequestFactory::class;

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
            'featured_image' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'game_media_id' => [
                'required',
                'integer',
                'exists:Domain\Game\Models\GameMedia,id'
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
            'is_main' => [
                'nullable',
                'boolean'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('common.name', 1),
            'slug' => __('common.slug'),
            'article_number' => trans_choice('common.article_numbers', 1),
            'alternative_names' => __('common.alternative_names'),
            'barcodes' => trans_choice('common.barcodes', 2),
            'description' => __('common.description'),
            'game_media_id' => trans_choice('game.media.medias', 2),
            'kit_items' => __('collectible.kit.items'),
            'featured_image' => __('common.featured_image'),
            'user_id' => trans_choice('user.users', 1),
            'images' => trans_choice('common.additional_image', 2),
            'is_main' => __('collectible.variation.main')
        ];
    }
}
