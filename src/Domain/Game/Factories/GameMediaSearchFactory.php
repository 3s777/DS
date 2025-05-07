<?php

namespace Domain\Game\Factories;

use Domain\Game\ViewModels\Public\GameMediaIndexViewModel;
use Domain\Shelf\Contracts\CategorySearchFactoryContract;
use Spatie\ViewModels\ViewModel;

class GameMediaSearchFactory implements CategorySearchFactoryContract
{

    public function view(): string
    {
        return 'content.category.game.index';
    }

    public function data(): ViewModel
    {
        return new GameMediaIndexViewModel();
    }
}
