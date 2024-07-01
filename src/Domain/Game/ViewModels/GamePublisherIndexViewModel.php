<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;

class GamePublisherIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function publishers()
    {
        return GamePublisher::query()
            ->select('game_publishers.id', 'game_publishers.name', 'game_publishers.created_at', 'game_publishers.slug', 'game_publishers.user_id', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'game_publishers.user_id')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
