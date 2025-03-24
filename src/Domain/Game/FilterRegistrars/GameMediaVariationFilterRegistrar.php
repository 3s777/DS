<?php

namespace Domain\Game\FilterRegistrars;

use App\Contracts\FilterRegistrar;
use App\Filters\BooleanFilter;
use App\Filters\DatesFilter;
use App\Filters\RelationFilter;
use App\Filters\RelationMultipleFilter;
use App\Filters\SearchFilter;
use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;

class GameMediaVariationFilterRegistrar implements FilterRegistrar
{
    public function filtersList(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'game_media_variations',
                placeholder: [
                    'from' => __('filters.dates_from'),
                    'to' => __('filters.dates_to'),
                ],
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'game_media_variations',
                alternativeFields: ['alternative_names', 'barcodes', 'article_number']
            ),
            'media' => RelationFilter::make(
                trans_choice('game.media.medias', 1),
                'media',
                'game_media_variations',
                GameMedia::class,
                'game_media_id',
                trans_choice('game.media.choose', 1)
            ),
            'user' => RelationFilter::make(
                trans_choice('user.users', 1),
                'user',
                'game_media_variations',
                User::class,
                'user_id',
                trans_choice('user.choose', 1)
            ),
            'is_main' => BooleanFilter::make(
                trans_choice('common.main',1),
                'is_main',
                'game_media_variations',
                'is_main'
            ),
        ];
    }
}
