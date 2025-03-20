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
                'game_media_variations.created_at',
                'game_media_variations.slug',
                'game_media_variations.user_id',
                'game_media_variations.game_media_id',
                'users.name as user_name'
            )
            ->with(['gameMedia:id,name'])
            ->leftJoin('users', 'users.id', '=', 'game_media_variations.user_id')
            ->filtered()
            ->sorted()
            ->paginate(100)
            ->withQueryString();
    }
}
