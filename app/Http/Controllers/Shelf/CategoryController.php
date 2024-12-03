<?php

namespace App\Http\Controllers\Shelf;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeletingRequest;
use App\Http\Requests\Shelf\CreateCategoryRequest;
use App\Http\Requests\Shelf\UpdateCategoryRequest;
use Domain\Shelf\DTOs\FillCategoryDTO;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Services\CategoryService;
use Domain\Shelf\ViewModel\CategoryIndexViewModel;
use Domain\Shelf\ViewModel\CategoryUpdateViewModel;
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

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.category.index', new CategoryIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.category.create');
    }

    public function store(CreateCategoryRequest $request, CategoryService $category): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $category->create(FillCategoryDTO::fromRequest($request));

        flash()->info(__('collectible.category.created'));

        return to_route('categories.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Category $category): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.category.edit', new CategoryUpdateViewModel($category));
    }

    public function update(UpdateCategoryRequest $request, Category $category, CategoryService $categoryService): RedirectResponse
    {
        $categoryService->update($category, FillCategoryDTO::fromRequest($request));

        flash()->info(__('collectible.category.updated'));

        return to_route('categories.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        flash()->info(__('collectible.category.deleted'));

        return to_route('categories.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                Category::class,
                $request->input('ids')
            )
        );

        flash()->info(__('collectible.category.mass_deleted'));

        return to_route('categories.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                Category::class,
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('collectible.category.mass_force_deleted'));

        return to_route('categories.index');
    }
}
