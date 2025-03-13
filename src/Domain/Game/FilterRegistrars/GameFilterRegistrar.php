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

class GameFilterRegistrar implements FilterRegistrar
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
                User::class,
                'user_id',
                trans_choice('user.choose', 1),
            ),
            'genres' => RelationMultipleFilter::make(
                trans_choice('game.genre.genres', 2),
                'genres',
                'game_genres',
                GameGenre::class,
                'id',
                trans_choice('game.genre.choose', 1)
            ),
            'developers' => RelationMultipleFilter::make(
                trans_choice('game.developer.developers', 2),
                'developers',
                'game_developers',
                GameDeveloper::class,
                'id',
                trans_choice('game.developer.choose', 1)
            ),
            'publishers' => RelationMultipleFilter::make(
                trans_choice('game.publisher.publishers', 2),
                'publishers',
                'game_publishers',
                GamePublisher::class,
                'id',
                trans_choice('game.publisher.choose', 1)
            ),
            'platforms' => RelationMultipleFilter::make(
                trans_choice('game.platform.platforms', 2),
                'platforms',
                'game_platforms',
                GamePlatform::class,
                'id',
                trans_choice('game.platform.choose', 1)
            ),
            'released_at' => DatesFilter::make(
                __('game.released_at'),
                'released_at',
                'games',
                'released_at',
                placeholder: [
                    'from' => __('game.released_at_from'),
                    'to' => __('game.released_at_to'),
                ]
            ),
        ];
    }
}
