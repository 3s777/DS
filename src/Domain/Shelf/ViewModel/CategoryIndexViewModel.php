<?php

namespace Domain\Shelf\ViewModel;

use Domain\Auth\Models\User;
use Domain\Game\Models\Game;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Spatie\ViewModels\ViewModel;

class CategoryIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function categories()
    {
        return Category::query()
            ->select('categories.id', 'categories.name', 'categories.slug', 'categories.created_at')
            ->orderBy('id', 'DESC')
            ->paginate(200)
            ->withQueryString();
    }
}
