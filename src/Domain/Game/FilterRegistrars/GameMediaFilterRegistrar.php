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
                __('user.choose'),
                User::class
            ),
            'genres' => RelationMultipleFilter::make(
                __('game_genre.genres'),
                'genres',
                'game_genres',
                'id',
                __('game_genre.choose'),
                GameGenre::class
            ),
            'developers' => RelationMultipleFilter::make(
                __('game_developer.developers'),
                'developers',
                'game_developers',
                'id',
                __('game_developer.choose'),
                GameDeveloper::class
            ),
            'publishers' => RelationMultipleFilter::make(
                __('game_publisher.publishers'),
                'publishers',
                'game_publishers',
                'id',
                __('game_publisher.choose'),
                GamePublisher::class
            ),
            'platforms' => RelationMultipleFilter::make(
                __('game_platform.platforms'),
                'platforms',
                'game_platforms',
                'id',
                __('game_platform.choose'),
                GamePlatform::class
            ),
        ];
    }
}
