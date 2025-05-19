<?php

namespace Domain\Game\Factories;

use Domain\Game\ViewModels\Public\GameMediaIndexViewModel;
use Domain\Game\ViewModels\Public\GameVariationsIndexViewModel;
use Domain\Shelf\Contracts\CategorySearchFactoryContract;
use Spatie\ViewModels\ViewModel;

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

    public function data(): ViewModel
    {
        return new GameMediaIndexViewModel();
    }

    public function variations(): GameVariationsIndexViewModel
    {
        return new GameVariationsIndexViewModel();
    }
}
