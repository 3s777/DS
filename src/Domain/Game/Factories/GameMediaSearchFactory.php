<?php

namespace Domain\Game\Factories;

use Domain\Shelf\Factories\CategorySearchFactory;
use Domain\Shelf\ViewModels\CategoryIndexViewModel;
use Spatie\ViewModels\ViewModel;

class GameMediaSearchFactory implements CategorySearchFactory
{

    public function view(): string
    {
        return 'content.search.index';
    }

    public function data(): ViewModel
    {
        return new CategoryIndexViewModel();
    }
}
