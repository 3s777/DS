<?php

namespace App\Http\Requests\Shelf;

use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Collectible;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCollectibleGameRequest extends FormRequest
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
                Rule::unique(Collectible::class)->ignore($this->collectible)
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
                'max: 100000000',
                'min: 0'
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
            'additional_field' => [
                'nullable',
                'string',
                'max:250'
            ],
            'properties.is_done' => [
                'boolean'
            ],
            'properties.is_digital' => [
                'boolean'
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
                Rule::enum(TargetEnum::class)
            ],
            'sale.price' => [
                'exclude_unless:target,sale',
                'required',
                'numeric',
                'max: 100000000',
                'min: 0'
            ],
            'sale.price_old' => [
                'exclude_unless:target,sale',
                'nullable',
                'numeric',
                'max: 100000000',
                'min: 0'
            ],
            'auction.price' => [
                'exclude_unless:target,auction',
                'required',
                'numeric',
                'max: 100000000',
                'min: 0'
            ],
            'auction.step' => [
                'exclude_unless:target,auction',
                'required',
                'numeric'
            ],
            'auction.to' => [
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
            'thumbnail_multiple' => [
                'nullable',
                'max: 9'
            ],
            'thumbnail_multiple.*' => [
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
            'kit_conditions' => __('collectible.kit_conditions'),
            'target' => __('collectible.target'),
            'sale.price' => __('collectible.sale_price'),
            'sale.price_old' => __('collectible.sale_price_old'),
            'auction.price' => __('collectible.auction_price'),
            'auction.step' => __('collectible.auction_step'),
            'auction.to' => __('collectible.auction_stop_date'),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
            'thumbnail_multiple' => trans_choice('common.additional_image', 2)
        ];
    }
}
