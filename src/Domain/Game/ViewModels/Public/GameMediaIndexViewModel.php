<?php

namespace Domain\Game\ViewModels\Public;

use Domain\Game\Models\GameMedia;
use Spatie\ViewModels\ViewModel;

class GameMediaIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function gameMedias()
    {
        return GameMedia::query()
            ->select(
                'game_medias.id',
                'game_medias.name',
                'game_medias.released_at',
                'game_medias.created_at',
                'game_medias.slug',
                'game_medias.description'
            )
            ->with([
                'games:id,name',
                'genres:id,name',
                'platforms:id,name',
                'developers:id,name',
                'publishers:id,name',
                'variations' => function ($query) {
                    $query->select(['id','slug','name','game_media_id','article_number','barcodes','is_main'])
                        ->with(['media'])
                        ->orderBy('is_main', 'DESC');
                },
                'media'
            ])
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
