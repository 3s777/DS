<?php

namespace Domain\Game\Factories;

use Admin\Shelf\ViewModels\CategoryIndexViewModel;
use Domain\Shelf\Contracts\CategorySearchFactoryContract;
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
