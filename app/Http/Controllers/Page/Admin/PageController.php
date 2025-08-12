<?php

namespace App\Http\Controllers\Page\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\Admin\CreatePageRequest;
use App\Http\Requests\Page\Admin\UpdatePageRequest;
use Domain\Page\DTOs\FillPageDTO;
use Domain\Page\Models\Page;
use Domain\Page\Services\Admin\PageService;
use Domain\Page\ViewModels\Admin\PageIndexViewModel;
use Domain\Page\ViewModels\Admin\PageUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class PageController extends Controller
{
    public function __construct()
    {
        //        $this->authorizeResource(KitItem::class, 'kit-item');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.page.page.index', new PageIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.page.page.create', new PageUpdateViewModel());
    }

    public function store(CreatePageRequest $request, PageService $pageService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $pageService->create(FillPageDTO::fromRequest($request));

        flash()->info(__('page.created'));

        return to_route('admin.pages.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Page $page): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.page.page.edit', new PageUpdateViewModel($page));
    }

    public function update(UpdatePageRequest $request, Page $page, PageService $pageService): RedirectResponse
    {
        $pageService->update($page, FillPageDTO::fromRequest($request));

        flash()->info(__('page.updated'));

        return to_route('admin.pages.index');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        flash()->info(__('page.deleted'));

        return to_route('admin.pages.index');
    }
}
