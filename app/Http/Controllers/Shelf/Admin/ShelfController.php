<?php

namespace App\Http\Controllers\Shelf\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeletingRequest;
use App\Http\Requests\Shelf\Admin\CreateShelfRequest;
use App\Http\Requests\Shelf\Admin\FilterShelfRequest;
use App\Http\Requests\Shelf\Admin\UpdateShelfRequest;
use Domain\Shelf\DTOs\FillShelfDTO;
use Domain\Shelf\Models\Shelf;
use Domain\Shelf\Services\ShelfService;
use Domain\Shelf\ViewModels\ShelfIndexViewModel;
use Domain\Shelf\ViewModels\ShelfUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Support\ViewModels\AsyncSelectAllViewModel;

class ShelfController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Shelf::class, 'shelf');
    }

    public function index(FilterShelfRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.shelf.index', new ShelfIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.shelf.create', new ShelfUpdateViewModel());
    }

    public function store(CreateShelfRequest $request, ShelfService $shelfService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $shelfService->create(FillShelfDTO::fromRequest($request));

        flash()->info(__('shelf.created'));

        return to_route('admin.shelves.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Shelf $shelf): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.shelf.edit', new ShelfUpdateViewModel($shelf));
    }

    public function update(UpdateShelfRequest $request, Shelf $shelf, ShelfService $shelfService): RedirectResponse
    {
        $shelfService->update($shelf, FillShelfDTO::fromRequest($request));

        flash()->info(__('shelf.updated'));

        return to_route('admin.shelves.index');
    }

    public function destroy(Shelf $shelf): RedirectResponse
    {
        $shelf->delete();

        flash()->info(__('shelf.deleted'));

        return to_route('admin.shelves.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Shelf\Models\Shelf',
                $request->input('ids')
            )
        );

        flash()->info(__('shelf.mass_deleted'));

        return to_route('admin.shelves.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Shelf\Models\Shelf',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('shelf.mass_force_deleted'));

        return to_route('admin.shelves.index');
    }

    public function getForSelect(Request $request): AsyncSelectAllViewModel
    {
        return new AsyncSelectAllViewModel(
            Shelf::class,
            trans_choice('shelf.choose', 1),
            $request->input('depended')
        );
    }
}
