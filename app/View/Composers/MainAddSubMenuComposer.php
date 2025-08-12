<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Domain\Shelf\Models\Category;
use Illuminate\View\View;

final class MainAddSubMenuComposer
{
    public function compose(View $view): void
    {
        $addMenu = Menu::make();

        $categories = Category::select('id', 'name', 'slug')->get();

        foreach ($categories as $category) {
            $addMenu->add(MenuItem::make(route('category.show', ['category' => $category->slug]), $category->name));
        }

        $view->with('addMenu', $addMenu);
    }
}
