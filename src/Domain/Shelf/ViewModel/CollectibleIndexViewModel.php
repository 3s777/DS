<?php

namespace Domain\Shelf\ViewModel;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Spatie\ViewModels\ViewModel;

class CollectibleIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function collectibles()
    {
        return Collectible::query()
            ->select('collectibles.id', 'collectibles.name', 'collectibles.article_number', 'collectibles.condition', 'collectibles.created_at', 'collectibles.user_id', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'collectibles.user_id')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
