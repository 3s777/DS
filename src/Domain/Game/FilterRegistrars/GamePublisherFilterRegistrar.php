<?php

namespace Domain\Game\FilterRegistrars;

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

class GamePublisherFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'game_publishers',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ],
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'game_publishers'
            ),
            'user' => RelationFilter::make(
                __('user.user'),
                'user',
                'game_publishers',
                'user_id',
                __('user.choose'),
                User::class
            ),
        ];
    }
}
