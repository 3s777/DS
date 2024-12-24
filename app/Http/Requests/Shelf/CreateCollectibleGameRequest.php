<?php

namespace App\Http\Requests\Shelf;

use Domain\Game\Models\GameMedia;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
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
            'category_id' => Category::where('model', Relation::getMorphAlias(GameMedia::class))->first()->id
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
            'category_id' => [
                'required',
                'integer',
                'exists:Domain\Shelf\Models\Category,id'
            ],
            'kit_conditions' => [
                'required'
            ],
            'kit_conditions.*' => [
                'sometimes',
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
                'required',
                'date',
                'date_format:Y-m-d'
            ],
            'description' => ['nullable','string'],
            'thumbnail' => [
                'nullable',
                'mimes:jpg,png',
                'max:10024'
            ],
            'thumbnail-multiple' => ['nullable']
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
            'sale.price' => __('collectible.sale_price'),
            'sale.price_old' => __('collectible.sale_price_old'),
            'auction.price' => __('collectible.auction_price'),
            'auction.step' => __('collectible.auction_step'),
            'auction.to' => __('collectible.auction_stop_date'),
            'description' => __('common.description'),
            'thumbnail' => __('common.thumbnail'),
        ];
    }
}
