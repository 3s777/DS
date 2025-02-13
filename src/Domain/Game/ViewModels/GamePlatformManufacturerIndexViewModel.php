<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GamePlatformManufacturer;
use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;

class GamePlatformManufacturerIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function manufacturers()
    {
        return GamePlatformManufacturer::query()
            ->select('game_platform_manufacturers.id', 'game_platform_manufacturers.name', 'game_platform_manufacturers.created_at', 'game_platform_manufacturers.slug', 'game_platform_manufacturers.user_id', 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', 'game_platform_manufacturers.user_id')
            ->orderBy('id', 'DESC')
            ->paginate(100)
            ->withQueryString();
    }
}
