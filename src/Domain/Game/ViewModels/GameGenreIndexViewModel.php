<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameGenre;
use Spatie\ViewModels\ViewModel;

class GameGenreIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function genres()
    {
        return GameGenre::query()
            ->select('game_genres.id', 'game_genres.name', 'game_genres.created_at', 'game_genres.slug', 'game_genres.user_id', 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', 'game_genres.user_id')
            ->paginate(10)
            ->withQueryString();
    }
}
