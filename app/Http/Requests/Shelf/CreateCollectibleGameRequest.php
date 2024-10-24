<?php

namespace App\Http\Requests\Shelf;

use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Models\Shelf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCollectibleGameRequest extends FormRequest
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
                Rule::unique(Shelf::class)
            ],
            'user_shelf' => [
                'required',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
            'shelf_id' => [
                'required',
                'integer',
                'exists:Domain\Shelf\Models\Shelf,id'
            ],
            'article_number' => [
                'nullable',
                'string',
                'max:250',
            ],
            'condition' => [
                'required',
                Rule::enum(ConditionEnum::class)
            ],
            'purchase_price' => [
                'nullable',
                'numeric',
                'max: 100000000'
            ],
            'seller' => [
                'nullable',
                'string',
                'max:250'
            ],
            'purchased_at' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'user_id' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
            'additional_field' => [
                'nullable',
                'string',
                'max:250'
            ],
            'is_done' => [
                'boolean'
            ],
            'is_digital' => [
                'boolean'
            ],
            'media' => [
                'required',
                'integer',
                'exists:Domain\Game\Models\GameMedia,id'
            ],
            'kit_conditions' => [
                'required'
            ],
            'kit_conditions.*' => [
                'sometimes',
                'numeric'
            ],
            'target' => [
              'required',
              'string'
            ],
            'sale_price' => [
                'exclude_unless:target,sale',
                'required',
                'numeric'
            ],
            'auction_price' => [
                'exclude_unless:target,auction',
                'required',
                'numeric'
            ],
            'auction_step' => [
                'exclude_unless:target,auction',
                'required',
                'numeric'
            ],
            'auction_stop_date' => [
                'exclude_unless:target,auction',
                'date',
                'date_format:Y-m-d'
            ],
            'description' => ['nullable','string'],
            'thumbnail' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('common.name'),
            'user_shelf' => trans_choice('user.users', 1),
            'shelf_id' => trans_choice('shelf.shelves', 1),
            'article_number' => trans_choice('common.article_numbers', 1),
            'condition' => __('common.condition'),
            'purchase_price' => __('common.purchase_price'),
            'seller' => __('collectible.seller'),
            'purchase_date' => __('collectible.purchase_date'),
            'additional_field' => __('common.additional_field'),
            'is_done' => __('game.is_done'),
            'is_digital' => __('game.is_digital'),
            'media' => trans_choice('collectible.media', 1),
            'kit_conditions' => __('collectible.kit_conditions'),
            'target' => __('collectible.target'),
            'sale_price' => __('collectible.sale_price'),
            'auction_price' => __('collectible.auction_price'),
            'auction_step' => __('collectible.auction_step'),
            'auction_stop_date' => __('collectible.auction_stop_date'),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
        ];
    }
}
