<?php

namespace Domain\Game\Factories;

use Domain\Game\ViewModels\GameMediaIndexViewModel;
use Domain\Game\ViewModels\GameVariationsIndexViewModel;
use Domain\Shelf\Contracts\CategorySearchFactoryContract;
use Domain\Shelf\Models\Category;
use Spatie\ViewModels\ViewModel;

class GameMediaSearchFactory implements CategorySearchFactoryContract
{
    public function __construct(private Category $category)
    {

    }
    public function view(): string
    {
        return 'content.category.game.index';
    }

    public function viewVariations(): string
    {
        return 'content.category.game.variations';
    }

    public function data(): ViewModel
    {
        return new GameMediaIndexViewModel($this->category);
    }

    public function variations(): GameVariationsIndexViewModel
    {
        return new GameVariationsIndexViewModel($this->category);
    }
}
