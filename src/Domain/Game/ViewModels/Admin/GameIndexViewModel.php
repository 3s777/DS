<?php

namespace Domain\Game\ViewModels\Admin;

use Domain\Game\Models\Game;
use Spatie\ViewModels\ViewModel;

class GameIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function games()
    {
        return Game::query()
//            ->with(['media.model:id,created_at'])
//            ->with(['media'])
//            ->with(['user:id,name,email'])
            ->select('games.id', 'games.name', 'games.created_at', 'games.slug', 'games.user_id', 'users.name as user_name')
            ->with(['genres:id,name', 'platforms:id,name', 'developers:id,name', 'publishers:id,name'])
            ->leftJoin('users', 'users.id', '=', 'games.user_id')
//            ->join('game_game_genre', 'games.id', '=', 'game_game_genre.game_id')
//            ->join('game_genres', 'game_genres.id', '=', 'game_game_genre.game_genre_id')
            ->filteredAdmin()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
