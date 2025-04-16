<?php

namespace App\Http\Controllers\Page\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\Admin\CreatePageCategoryRequest;
use App\Http\Requests\Page\Admin\UpdatePageCategoryRequest;
use Domain\Page\DTOs\FillPageCategoryDTO;
use Domain\Page\Models\PageCategory;
use Domain\Page\Services\Admin\PageCategoryService;
use Domain\Page\ViewModels\Admin\PageCategoryIndexViewModel;
use Domain\Page\ViewModels\Admin\PageCategoryUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use App\Http\Requests\MassDeletingRequest;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;

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
        return view('admin.page.category.create');
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

        /**
         * @throws MassDeletingException
         */
        public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
        {
            $deletingAction(
                MassDeletingDTO::make(
                    PageCategory::class,
                    $request->input('ids')
                )
            );

            flash()->info(__('page.category.mass_deleted'));

            return to_route('admin.page-categories.index');
        }

        /**
         * @throws MassDeletingException
         */
        public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
        {
            $deletingAction(
                MassDeletingDTO::make(
                    PageCategory::class,
                    $request->input('ids'),
                    true
                )
            );

            flash()->info(__('page.category.mass_force_deleted'));

            return to_route('admin.page-categories.index');
        }
}
