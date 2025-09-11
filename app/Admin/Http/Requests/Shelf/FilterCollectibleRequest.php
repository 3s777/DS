<?php

namespace App\Admin\Http\Requests\Shelf;

use Illuminate\Foundation\Http\FormRequest;

class FilterCollectibleRequest extends FormRequest
{
    protected $redirectRoute = 'admin.collectibles.index';

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
            'filters.search' => [
                'nullable',
                'string',
                'max:250'
            ],
            'filters.dates.from' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.dates.to' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.user' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\User,id'
            ],
            'filters.condition' => ['nullable', 'array'],
            'filters.collector' => [
                'nullable',
                'integer',
                'exists:Domain\Auth\Models\Collector,id'
            ],
            'filters.category' => [
                'nullable',
                'integer',
                'exists:Domain\Shelf\Models\Category,id'
            ],
            'filters.target' => [
                'nullable',
                'string',
                'max:250'
            ],
            'filters.purchased_dates.from' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.purchased_dates.to' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.seller' => [
                'nullable',
                'string',
                'max:250'
            ],
            'filters.additional_field' => [
                'nullable',
                'string',
                'max:250'
            ],
            'filters.purchase_price.from' => [
                'nullable',
                'numeric',
            ],
            'filters.purchase_price.to' => [
                'nullable',
                'numeric',
            ],
            'filters.sale_price.from' => [
                'nullable',
                'numeric',
            ],
            'filters.sale_price.to' => [
                'nullable',
                'numeric',
            ],
            'filters.kit_score.from' => [
                'nullable',
                'integer',
            ],
            'filters.kit_score.to' => [
                'nullable',
                'integer',
            ],
            'filters.auction_dates.from' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'filters.auction_dates.to' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
        ];
    }

    public function messages()
    {
        return [
            'filters.dates.from' => __('validation.filters_date'),
            'filters.dates.to' => __('validation.filters_date'),
        ];
    }

    public function attributes()
    {
        return [
            'filters.search' => __('common.search'),
            'filters.dates' => __('common.dates'),
            'filters.user' => trans_choice('user.users', 1),
            'filters.condition' => __('common.condition'),
            'filters.collector' => trans_choice('user.collectors', 1),
            'filters.category' => trans_choice('collectible.category.categories', 1),
            'filters.target' => __('collectible.target'),
            'filters.purchased_dates.from' => __('collectible.purchased_at_from'),
            'filters.purchased_dates.to' => __('collectible.purchased_at_to'),
            'filters.seller' => __('collectible.seller'),
            'filters.additional_field' => trans_choice('common.additional_fields', 1),
            'filters.purchase_price.from' => __('collectible.purchase_price_from'),
            'filters.purchase_price.to' => __('collectible.purchase_price_to'),
            'filters.sale_price.from' => __('collectible.sale.price_from'),
            'filters.sale_price.to' => __('collectible.sale.price_to'),
            'filters.kit_score.from' => __('collectible.kit.score_from'),
            'filters.kit_score.to' => __('collectible.kit.score_to'),
            'filters.auction_dates.from' => __('collectible.auction.at_from'),
            'filters.auction_dates.to' => __('collectible.auction.at_to')
        ];
    }
}
