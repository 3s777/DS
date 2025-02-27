<?php

namespace App\Http\Requests\Shelf\Admin;

use Domain\Game\Models\GameMedia;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
use Illuminate\Database\Eloquent\Relations\Relation;
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

    protected function prepareForValidation()
    {
        $this->merge([
            'collectable_type' => Relation::getMorphAlias(GameMedia::class),
        ]);
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
                Rule::unique(Collectible::class)
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
            'collectable' => [
                'required',
                'integer',
                'exists:Domain\Game\Models\GameMedia,id'
            ],
            'collectable_type' => [
                'required',
                'string'
            ],
            'kit_score' => [
                'nullable',
                'integer'
            ],
            'kit_conditions' => [
                'required'
            ],
            'kit_conditions.*' => [
                'nullable',
                'integer'
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
            'sale.quantity' => [
                'exclude_unless:target,sale',
                'required',
                'numeric',
                'max: 100000000',
                'min: 1'
            ],
            'sale.bidding' => [
                'exclude_unless:target,sale',
                'nullable',
                'boolean',
            ],
            'sale.reservation' => [
                'exclude_unless:target,sale',
                'required',
                Rule::enum(ReservationEnum::class)
            ],
            'self_delivery' => [
                Rule::excludeIf(function () {
                    return $this->target !== 'sale' && $this->target !== 'auction';
                }),
                'nullable',
                'boolean',
            ],
            'country_id' => [
                Rule::excludeIf(function () {
                    return $this->target !== 'sale' && $this->target !== 'auction';
                }),
                'required',
                'integer',
                'exists:Domain\Settings\Models\Country,id'
            ],
            'shipping' => [
                Rule::excludeIf(function () {
                    return $this->target !== 'sale' && $this->target !== 'auction';
                }),
                'required',
                Rule::enum(ShippingEnum::class)
            ],
            'shipping_countries' => [
                'exclude_unless:shipping,selected',
                'required',
                'array',
                'exists:Domain\Settings\Models\Country,id'
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
            'auction.finished_at' => [
                'exclude_unless:target,auction',
                'required',
                'date',
                'after:now'
            ],
            'auction.blitz' => [
                'exclude_unless:target,auction',
                'nullable',
                'numeric'
            ],
            'auction.renewal' => [
                'exclude_unless:target,auction',
                'nullable',
                'numeric'
            ],
            'description' => ['nullable','string'],
            'featured_image' => [
                'nullable',
                'mimes:jpg,png,jpeg',
                'max:10024'
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
            'collectable' => trans_choice('collectible.collectable', 1),
            'kit_conditions' => __('collectible.kit_conditions'),
            'target' => __('collectible.target'),
            'sale.price' => __('collectible.sale.price'),
            'sale.price_old' => __('collectible.sale.price_old'),
            'sale.quantity' => __('common.quantity'),
            'sale.reservation' => __('collectible.reservation.choose'),
            'sale.bidding' => __('collectible.sale.bidding'),
            'country_id' => trans_choice('settings.country.countries', 1),
            'shipping' => __('collectible.shipping.option'),
            'shipping_countries' => __('collectible.shipping.choose_countries'),
            'self_delivery' => __('collectible.shipping.self_delivery'),
            'auction.price' => __('collectible.auction.price'),
            'auction.step' => __('collectible.auction.step'),
            'auction.finished_at' => __('collectible.auction.finished_at'),
            'auction.blitz' => __('collectible.auction.blitz'),
            'auction.renewal' => __('collectible.auction.renewal'),
            'description' => __('common.description'),
            'featured_image' => __('common.featured_image'),
            'images' => trans_choice('common.additional_image', 2)
        ];
    }

    public function messages()
    {
        return [
            'after' => __('validation.date_less_now'),
        ];
    }
}
