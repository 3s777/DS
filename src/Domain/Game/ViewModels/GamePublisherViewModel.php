<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;

class GamePublisherViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function publishers()
    {
        //        return Cache::rememberForever('game_developers_index', function () {
        return GamePublisher::query()
            ->select(['id', 'name', 'slug', 'created_at'])
            ->filtered()
            ->sorted()
            ->paginate(4)
            ->withQueryString();
        //        });
    }
}
