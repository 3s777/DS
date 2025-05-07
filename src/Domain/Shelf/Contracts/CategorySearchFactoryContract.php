<?php

namespace Domain\Shelf\Contracts;

use Spatie\ViewModels\ViewModel;

interface CategorySearchFactoryContract
{
    public function view(): string;

    public function data(): ViewModel;
}
