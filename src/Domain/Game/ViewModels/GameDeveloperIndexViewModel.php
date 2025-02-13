<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameDeveloper;
use Spatie\ViewModels\ViewModel;

class GameDeveloperIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function filteredUser()
    {
        //        if(request()->input('filters.user')) {
        //            $user = User::find(request()->input('filters.user'));
        //            return $user;
        //        }

        return '';
    }

    public function developers()
    {
        return GameDeveloper::query()
//            ->with(['media.model:id,created_at'])
//            ->with(['media'])
//            ->with(['user:id,name,email'])
            ->select('game_developers.id', 'game_developers.name', 'game_developers.created_at', 'game_developers.slug', 'game_developers.user_id', 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', 'game_developers.user_id')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
