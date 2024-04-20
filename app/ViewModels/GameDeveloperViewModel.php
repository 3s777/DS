<?php

namespace App\ViewModels;

use Domain\Game\Models\GameDeveloper;
use Illuminate\Support\Facades\Cache;
use Spatie\ViewModels\ViewModel;

class GameDeveloperViewModel extends ViewModel
{
    public function __construct()
    {
        //
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
