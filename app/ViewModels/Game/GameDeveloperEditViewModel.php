<?php

namespace App\ViewModels\Game;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Spatie\ViewModels\ViewModel;

class GameDeveloperEditViewModel extends ViewModel
{
    public $gameDeveloper;

    public $users;

    public function __construct(User $users, GameDeveloper $gameDeveloper = null)
    {
        $this->users = $users;
        $this->gameDeveloper = $gameDeveloper;
    }

    public function developers() {
        return GameDeveloper::query()
//            ->with(['media.model:id,created_at'])
//            ->with(['media'])
//            ->with(['user:id,name,email'])
            ->select('game_developers.id', 'game_developers.name', 'game_developers.created_at', 'game_developers.slug', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'game_developers.user_id')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
