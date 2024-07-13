<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
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
            ->join('users', 'users.id', '=', 'games.user_id')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
