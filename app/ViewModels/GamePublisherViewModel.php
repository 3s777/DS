<?php

namespace App\ViewModels;

use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GamePublisher;
use Illuminate\Support\Facades\Cache;
use Spatie\ViewModels\ViewModel;

class GamePublisherViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function publishers() {
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
