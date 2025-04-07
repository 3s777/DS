<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Spatie\ViewModels\ViewModel;

class GameMediaVariationIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function gameMediaVariations()
    {
        return GameMediaVariation::query()
            ->select(
                'game_media_variations.id',
                'game_media_variations.name',
                'game_media_variations.article_number',
                'game_media_variations.alternative_names',
                'game_media_variations.created_at',
                'game_media_variations.slug',
                'game_media_variations.user_id',
                'game_media_variations.game_media_id',
                'game_media_variations.is_main',
                'game_medias.name as game_media_name',
                'users.name as user_name'
            )
            ->leftJoin('game_medias', 'game_medias.id', '=', 'game_media_variations.game_media_id')
            ->leftJoin('users', 'users.id', '=', 'game_media_variations.user_id')
            ->filteredAdmin()
            ->sorted()
            ->paginate(100)
            ->withQueryString();
    }
}
