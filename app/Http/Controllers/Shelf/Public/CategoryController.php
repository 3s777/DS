<?php

namespace App\Http\Controllers\Shelf\Public;

use App\Http\Controllers\Controller;
use Domain\Shelf\Contracts\CategorySearchFactoryContract;
use Domain\Shelf\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        //        $this->authorizeResource(KitItem::class, 'kit-item');
    }

    public function show(Category $category)
    {
        $factory = app()->make(CategorySearchFactoryContract::class, [
           'model' => $category->model
        ]);

        return view($factory->view(), $factory->data());
    }

}
