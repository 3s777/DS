<?php

namespace Domain\Game\ViewModels\Admin;

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
//            ->with(['media.model:id,created_at'])
//            ->with(['media'])
//            ->with(['user:id,name,email'])
            ->select('game_medias.id', 'game_medias.name', 'game_medias.created_at', 'game_medias.slug', 'game_medias.user_id', 'users.name as user_name')
            ->with(['genres:id,name', 'platforms:id,name', 'developers:id,name', 'publishers:id,name'])
            ->leftJoin('users', 'users.id', '=', 'game_medias.user_id')
//            ->join('game_game_genre', 'games.id', '=', 'game_game_genre.game_id')
//            ->join('game_genres', 'game_genres.id', '=', 'game_game_genre.game_genre_id')
            ->filteredAdmin()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
