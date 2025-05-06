<?php

namespace App\Http\Controllers\Shelf\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeletingRequest;
use App\Http\Requests\Shelf\Admin\CreateCategoryRequest;
use App\Http\Requests\Shelf\Admin\UpdateCategoryRequest;
use Domain\Game\Factories\GameMediaSearchFactory;
use Domain\Shelf\DTOs\FillCategoryDTO;
use Domain\Shelf\Factories\CategorySearchFactory;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Services\CategoryService;
use Domain\Shelf\ViewModels\CategoryIndexViewModel;
use Domain\Shelf\ViewModels\CategoryUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;

class CategoryController extends Controller
{
    public function __construct()
    {
        //        $this->authorizeResource(KitItem::class, 'kit-item');
    }

    public function show(Category $category)
    {
        $factory = app()->make(CategorySearchFactory::class, [
           'model' => $category->model
        ]);
        dd($factory->view());
        return view('content.search.index');
    }

}
