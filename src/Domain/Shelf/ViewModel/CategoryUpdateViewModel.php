<?php

namespace Domain\Shelf\ViewModel;

use Domain\Shelf\Models\Category;
use Illuminate\Support\Arr;
use Spatie\ViewModels\ViewModel;

class CategoryUpdateViewModel extends ViewModel
{
    public ?Category $category;

    public function __construct(Category $category = null)
    {
        $this->category = $category;
    }

    public function category(): ?Category
    {
        return $this->category ?? null;
    }

    public function collectables(): array
    {
        return Arr::map(config('settings.collectables'), fn($value) => __($value));
    }
}
