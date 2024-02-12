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
        return Cache::rememberForever('game_developers_index', function () {
            return GameDeveloper::query()
                ->select(['id', 'name', 'slug', 'created_at'])
                ->filtered()
                ->sorted()
                ->paginate(4)
                ->withQueryString();
        });

    }

}
