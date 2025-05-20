<?php

namespace Domain\Game\ViewModels\Public;

use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Spatie\ViewModels\ViewModel;

class GameVariationsIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function variations()
    {
        return GameMediaVariation::query()
            ->select(
                'game_media_variations.id',
                'game_media_variations.name',
                'game_media_variations.created_at',
                'game_media_variations.slug',
            )
            ->with([
//                'games:id,name',
//                'genres:id,name',
//                'platforms:id,name',
//                'developers:id,name',
//                'publishers:id,name',
//                'variations' => function($query) {
//                    $query->select(['id','slug','name','game_media_id','article_number','barcodes','is_main'])
//                        ->with(['media'])
//                        ->orderBy('is_main', 'DESC');
//                },
                'media'
            ])
            ->filtered()
            ->sorted()
            ->paginate(20)
            ->withQueryString();
    }
}
