<?php

namespace Domain\Shelf\FilterRegistrars;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
use App\Filters\RelationFilter;
use App\Filters\RelationMultipleFilter;
use App\Filters\SearchFilter;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;

class ShelfFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'games',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ]
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'games',
                alternativeFields: ['alternative_names']
            ),
            'user' => RelationFilter::make(
                trans_choice('user.users', 1),
                'user',
                'games',
                'user_id',
                trans_choice('user.choose', 1),
                User::class
            ),
        ];
    }
}
