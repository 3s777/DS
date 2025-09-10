<?php

namespace Admin\Shelf\ViewModels;

use Domain\Shelf\Models\Category;
use Spatie\ViewModels\ViewModel;

class CategoryIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function categories()
    {
        return Category::query()
            ->select('categories.id', 'categories.name', 'categories.slug', 'categories.created_at')
            ->orderBy('id', 'DESC')
            ->paginate(200)
            ->withQueryString();
    }
}
