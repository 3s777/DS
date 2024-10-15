<?php

namespace Domain\Shelf\ViewModel;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Spatie\ViewModels\ViewModel;

class KitItemIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function kitItems()
    {
        return KitItem::query()
            ->select('kit_items.id', 'kit_items.name', 'kit_items.slug', 'kit_items.created_at')
            ->orderBy('id', 'DESC')
            ->paginate(200)
            ->withQueryString();
    }
}
