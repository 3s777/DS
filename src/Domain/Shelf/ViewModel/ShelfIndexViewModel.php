<?php

namespace Domain\Shelf\ViewModel;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Shelf\Models\Shelf;
use Spatie\ViewModels\ViewModel;

class ShelfIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function shelves()
    {
        return Shelf::query()
            ->select('shelves.id', 'shelves.name', 'shelves.number', 'shelves.created_at', 'shelves.user_id', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'shelves.user_id')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
