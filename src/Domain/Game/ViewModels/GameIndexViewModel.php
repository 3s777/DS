<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Spatie\ViewModels\ViewModel;

class GameIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function genres(): array
    {
        return GameGenre::select('id', 'name')->get()->toArray();
    }

    public function platforms(): array
    {
        return GamePlatform::select('id', 'name')->get()->toArray();
    }

    public function games()
    {
        return Game::query()
//            ->with(['media.model:id,created_at'])
//            ->with(['media'])
//            ->with(['user:id,name,email'])
            ->select('games.id', 'games.name', 'games.created_at', 'games.slug', 'games.user_id', 'users.name as user_name')
            ->with(['genres:id,name', 'platforms:id,name'])
            ->join('users', 'users.id', '=', 'games.user_id')
//            ->join('game_game_genre', 'games.id', '=', 'game_game_genre.game_id')
//            ->join('game_genres', 'game_genres.id', '=', 'game_game_genre.game_genre_id')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
