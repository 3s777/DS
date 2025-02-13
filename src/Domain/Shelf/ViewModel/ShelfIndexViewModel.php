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
            ->select('shelves.id', 'shelves.name', 'shelves.number', 'shelves.created_at', 'shelves.collector_id', 'collectors.name as collector_name')
            ->join('collectors', 'collectors.id', '=', 'shelves.collector_id')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}
