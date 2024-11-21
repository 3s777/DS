<?php

namespace Domain\Game\FilterRegistrars;

use App\Contracts\FilterRegistrar;
use App\Filters\DatesFilter;
use App\Filters\RelationFilter;
use App\Filters\RelationMultipleFilter;
use App\Filters\SearchFilter;
use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;

class GameMediaFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'game_medias',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ],
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'game_medias',
                alternativeFields: ['alternative_names']
            ),
            'user' => RelationFilter::make(
                trans_choice('user.users', 1),
                'user',
                'game_medias',
                'user_id',
                trans_choice('user.choose', 1),
                User::class
            ),
            'genres' => RelationMultipleFilter::make(
                trans_choice('game_genre.genres', 2),
                'genres',
                'game_genres',
                'id',
                trans_choice('game_genre.choose', 1),
                GameGenre::class
            ),
            'developers' => RelationMultipleFilter::make(
                trans_choice('game_developer.developers', 2),
                'developers',
                'game_developers',
                'id',
                trans_choice('game_developer.choose', 1),
                GameDeveloper::class
            ),
            'publishers' => RelationMultipleFilter::make(
                trans_choice('game_publisher.publishers', 2),
                'publishers',
                'game_publishers',
                'id',
                trans_choice('game_publisher.choose', 1),
                GamePublisher::class
            ),
            'platforms' => RelationMultipleFilter::make(
                trans_choice('game_platform.platforms', 2),
                'platforms',
                'game_platforms',
                'id',
                trans_choice('game_platform.choose', 1),
                GamePlatform::class
            ),
            'games' => RelationMultipleFilter::make(
                trans_choice('game.games', 2),
                'games',
                'games',
                'id',
                trans_choice('game.choose', 1),
                Game::class
            ),
        ];
    }
}
