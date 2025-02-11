<?php

namespace Domain\Shelf\FilterRegistrars;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
use App\Filters\EnumFilter;
use App\Filters\RangeFilter;
use App\Filters\RelationFilter;
use App\Filters\SearchFilter;
use Domain\Auth\Models\User;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Domain\Shelf\Models\Category;

class CollectibleFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'collectibles',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ]
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'collectibles',
                alternativeFields: ['article_number']
            ),
            'user' => RelationFilter::make(
                trans_choice('user.users', 1),
                'user',
                'collectibles',
                'user_id',
                trans_choice('user.choose', 1),
                User::class
            ),
            'condition' => EnumFilter::make(
                __('common.condition'),
                'condition',
                'collectibles',
                ConditionEnum::class,
                'condition',
                __('common.choose_condition')
            ),
            'category' => RelationFilter::make(
                trans_choice('collectible.category.categories', 1),
                'category',
                'collectibles',
                'category_id',
                trans_choice('collectible.category.choose', 1),
                Category::class
            ),
//            'collectable_type' => EnumFilter::make(
//                trans_choice('collectible.type', 1),
//                'collectable_type',
//                'collectibles',
//                CollectibleTypeEnum::class,
//                'collectable_type',
//                __('collectible.choose_type'),
//                function ($value) {
//                    $types = CollectibleTypeEnum::cases();
//
//                    foreach($types as $type) {
//                        if($type->morphName() == $value) {
//                            return $type->name();
//                        }
//                    }
//
//                    return '';
//                }
//            ),
            'target' => EnumFilter::make(
                __('collectible.target'),
                'target',
                'collectibles',
                TargetEnum::class,
                'target',
                __('collectible.choose_target')
            ),
            'purchased_dates' => DatesFilter::make(
                __('collectible.purchased_at'),
                'purchased_dates',
                'collectibles',
                'purchased_at',
                placeholder: [
                    'from' => __('collectible.purchased_at_from'),
                    'to' => __('collectible.purchased_at_to'),
                ]
            ),
            'seller' => SearchFilter::make(
                __('collectible.seller'),
                'seller',
                'collectibles',
                'seller'
            ),
            'additional_field' => SearchFilter::make(
                trans_choice('common.additional_fields', 1),
                'additional_field',
                'collectibles',
                'additional_field'
            ),
            'purchase_price' => RangeFilter::make(
                __('collectible.purchase_price'),
                'purchase_price',
                'collectibles',
                'purchase_price',
                isPrice: true
            ),
            'sale_price' => RangeFilter::make(
                __('collectible.sale.price'),
                'sale_price',
                'sales',
                'price',
                isPrice: true,
                relation: 'sale'
            ),
            'auction_dates' => DatesFilter::make(
                __('collectible.auction.finished_at'),
                'auction_dates',
                'auctions',
                'finished_at',
                relation: 'auction',
                placeholder: [
                    'from' => __('collectible.auction.at_from'),
                    'to' => __('collectible.auction.at_to'),
                ]
            ),
        ];
    }
}
