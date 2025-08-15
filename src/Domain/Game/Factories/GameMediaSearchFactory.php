<?php

namespace Domain\Game\Factories;

use Domain\Game\ViewModels\Public\GameMediaIndexViewModel;
use Domain\Game\ViewModels\Public\GameVariationsIndexViewModel;
use Domain\Shelf\Contracts\CategorySearchFactoryContract;
use Spatie\ViewModels\ViewModel;
use Domain\Shelf\Models\Category;

class GameMediaSearchFactory implements CategorySearchFactoryContract
{
    public function view(): string
    {
        return 'content.category.game.index';
    }

    public function viewVariations(): string
    {
        return 'content.category.game.variations';
    }

    public function data(Category $category): ViewModel
    {
        return new GameMediaIndexViewModel($category);
    }

    public function variations(Category $category): GameVariationsIndexViewModel
    {
        return new GameVariationsIndexViewModel($category);
    }
}
