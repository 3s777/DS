<?php

namespace Domain\Shelf\FilterRegistrars;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
use App\Filters\EnumFilter;
use App\Filters\RelationFilter;
use App\Filters\RelationMultipleFilter;
use App\Filters\SearchFilter;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Enums\TargetEnum;
use Illuminate\Support\Arr;

class CollectibleFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.collectibles'),
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
                alternativeFields: ['alternative_names']
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
            'type' => EnumFilter::make(
                trans_choice('collectible.type', 1),
                'collectable_type',
                'collectibles',
                CollectibleTypeEnum::class,
                'collectable_type',
                __('collectible.choose_type'),
                function ($value) {
                    $types = CollectibleTypeEnum::cases();

                    foreach($types as $type) {
                        if($type->morphName() == $value) {
                            return $type->name();
                        }
                    }

                    return '';
                }
            ),
            'target' => EnumFilter::make(
                __('collectible.target'),
                'target',
                'collectibles',
                TargetEnum::class,
                'target',
                __('common.choose_target')
            ),
        ];
    }
}
