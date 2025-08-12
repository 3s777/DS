<?php

namespace App\Http\Requests\Game\Admin;

use Domain\Game\Models\GameMediaVariation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGameMediaVariationRequest extends FormRequest
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
                Rule::unique(GameMediaVariation::class)->ignore($this->game_media_variation)
            ],
            'slug' => [
                'nullable',
                'string',
                'max:250',
                Rule::unique(GameMediaVariation::class)->ignore($this->game_media_variation)
            ],
            'game_media_id' => [
                'required',
                'integer',
                'exists:Domain\Game\Models\GameMedia,id'
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
            'featured_image_selected' => ['nullable', 'bool'],
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
