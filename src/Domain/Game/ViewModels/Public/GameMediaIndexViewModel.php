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
            ->select('game_medias.id', 'game_medias.name', 'game_medias.created_at', 'game_medias.slug')
            ->with(['genres:id,name', 'platforms:id,name', 'developers:id,name', 'publishers:id,name'])
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
