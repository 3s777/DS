<?php

namespace App\Http\Controllers\Shelf\Public;

use App\Http\Controllers\Controller;
use Domain\Shelf\Contracts\CategorySearchFactoryContract;
use Domain\Shelf\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
        //        $this->authorizeResource(KitItem::class, 'kit-item');
    }

    public function show(Request $request, Category $category)
    {
        $factory = app()->make(CategorySearchFactoryContract::class, [
           'model' => $category->model
        ]);

        return view($factory->view(), $factory->data());
    }

    public function variations(Request $request, Category $category)
    {
        $factory = app()->make(CategorySearchFactoryContract::class, [
            'model' => $category->model
        ]);

        return view($factory->viewVariations(), $factory->variations());
    }

}
