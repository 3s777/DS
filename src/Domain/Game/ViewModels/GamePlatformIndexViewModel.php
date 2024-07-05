<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GamePlatform;
use Spatie\ViewModels\ViewModel;

class GamePlatformIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function platforms()
    {
        return GamePlatform::query()
            ->select('game_platforms.id', 'game_platforms.name', 'game_platforms.created_at', 'game_platforms.slug', 'game_platforms.user_id', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'game_platforms.user_id')
            ->orderBy('id', 'DESC')
            ->paginate(100)
            ->withQueryString();
    }
}
