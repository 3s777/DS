<?php

namespace Domain\Game\Factories;

use Domain\Shelf\Factories\CategorySearchFactory;
use Domain\Shelf\ViewModels\CategoryIndexViewModel;
use Spatie\ViewModels\ViewModel;

class BookSearchFactory implements CategorySearchFactory
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
