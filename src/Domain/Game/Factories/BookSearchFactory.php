<?php

namespace Domain\Game\Factories;

use Domain\Shelf\Contracts\CategorySearchFactoryContract;
use Domain\Shelf\ViewModels\CategoryIndexViewModel;
use Spatie\ViewModels\ViewModel;

class BookSearchFactory implements CategorySearchFactoryContract
{

    public function view(): string
    {
        return 'book';
    }

    public function data(): ViewModel
    {
        return new CategoryIndexViewModel();
    }
}
