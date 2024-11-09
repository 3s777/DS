<?php

namespace App\Http\Controllers\Shelf;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeletingRequest;
use App\Http\Requests\Shelf\CreateShelfRequest;
use App\Http\Requests\Shelf\UpdateShelfRequest;
use Domain\Game\Models\GameDeveloper;
use Domain\Shelf\DTOs\FillShelfDTO;
use Domain\Shelf\Models\Shelf;
use Domain\Shelf\Services\ShelfService;
use Domain\Shelf\ViewModel\ShelfIndexViewModel;
use Domain\Shelf\ViewModel\ShelfUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\ViewModels\AsyncSelectAllViewModel;
use Support\ViewModels\AsyncSelectByQueryViewModel;

class ShelfController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Shelf::class, 'shelf');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
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

        return to_route('shelves.index');
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

        return to_route('shelves.index');
    }

    public function destroy(Shelf $shelf): RedirectResponse
    {
        $shelf->delete();

        flash()->info(__('shelf.deleted'));

        return to_route('shelves.index');
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

        return to_route('shelves.index');
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

        return to_route('shelves.index');
    }

    public function getForSelect(Request $request): AsyncSelectAllViewModel
    {
        return new AsyncSelectAllViewModel(
            Shelf::class,
            trans_choice('shelf.choose', 1),
            true
        );
    }
}
