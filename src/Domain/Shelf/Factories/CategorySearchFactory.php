<?php

namespace Domain\Shelf\Factories;

use Spatie\ViewModels\ViewModel;

interface CategorySearchFactory
{
    public function view(): string;

    public function data(): ViewModel;
}
