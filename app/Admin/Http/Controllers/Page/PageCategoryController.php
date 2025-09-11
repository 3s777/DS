<?php

namespace App\Admin\Http\Controllers\Page;

use Admin\Page\DTOs\FillPageCategoryDTO;
use Admin\Page\Services\PageCategoryService;
use Admin\Page\ViewModels\PageCategoryIndexViewModel;
use Admin\Page\ViewModels\PageCategoryUpdateViewModel;
use App\Admin\Http\Requests\Page\CreatePageCategoryRequest;
use App\Admin\Http\Requests\Page\UpdatePageCategoryRequest;
use App\Http\Controllers\Controller;
use Domain\Page\Models\PageCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class PageCategoryController extends Controller
{
    public function __construct()
    {
        //        $this->authorizeResource(PageCategory::class, 'page-category');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.page.category.index', new PageCategoryIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.page.category.create', new PageCategoryUpdateViewModel());
    }

    public function store(CreatePageCategoryRequest $request, PageCategoryService $pageCategoryService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $pageCategoryService->create(FillPageCategoryDTO::fromRequest($request));

        flash()->info(__('page.category.created'));

        return to_route('admin.page-categories.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(PageCategory $pageCategory): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.page.category.edit', new PageCategoryUpdateViewModel($pageCategory));
    }

    public function update(UpdatePageCategoryRequest $request, PageCategory $pageCategory, PageCategoryService $pageCategoryService): RedirectResponse
    {
        $pageCategoryService->update($pageCategory, FillPageCategoryDTO::fromRequest($request));

        flash()->info(__('page.category.updated'));

        return to_route('admin.page-categories.index');
    }

    public function destroy(PageCategory $pageCategory): RedirectResponse
    {
        $pageCategory->delete();

        flash()->info(__('page.category.deleted'));

        return to_route('admin.page-categories.index');
    }
}
