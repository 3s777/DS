<?php

namespace Domain\Shelf\Contracts;

use Domain\Shelf\Models\Category;
use Spatie\ViewModels\ViewModel;

interface  CategorySearchFactoryContract
{
    public function view(): string;

    public function viewVariations(): string;

    public function data(Category $category): ViewModel;

    public function variations(Category $category): ViewModel;
}
