<?php

namespace App\Http\Controllers\Shelf;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeletingRequest;
use App\Http\Requests\Shelf\CreateKitItemRequest;
use App\Http\Requests\Shelf\GetKitItemConditionRequest;
use App\Http\Requests\Shelf\UpdateKitItemRequest;
use Domain\Shelf\Services\CollectibleService;
use Domain\Shelf\ViewModel\KitItemConditionViewModel;
use Domain\Shelf\ViewModel\KitItemUpdateViewModel;
use Domain\Shelf\DTOs\FillKitItemDTO;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Services\KitItemService;
use Domain\Shelf\ViewModel\KitItemIndexViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;


class KitItemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(KitItem::class, 'kit-item');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.kit-item.index', new KitItemIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.kit-item.create');
    }

    public function store(CreateKitItemRequest $request, KitItemService $kitItemService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $kitItemService->create(FillKitItemDTO::fromRequest($request));

        flash()->info(__('collectible.kit.created'));

        return to_route('kit-items.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(KitItem $kitItem): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.kit-item.edit', new KitItemUpdateViewModel($kitItem));
    }

    public function update(UpdateKitItemRequest $request, KitItem $kitItem, KitItemService $kitItemService): RedirectResponse
    {
        $kitItemService->update($kitItem, FillKitItemDTO::fromRequest($request));

        flash()->info(__('collectible.kit.updated'));

        return to_route('kit-items.index');
    }

    public function destroy(KitItem $kitItem): RedirectResponse
    {
        $kitItem->delete();

        flash()->info(__('collectible.kit.deleted'));

        return to_route('kit-items.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Shelf\Models\KitItem',
                $request->input('ids')
            )
        );

        flash()->info(__('collectible.kit.mass_deleted'));

        return to_route('kit-items.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Shelf\Models\KitItem',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('collectible.kit.mass_force_deleted'));

        return to_route('kit-items.index');
    }

    public function getHtmlConditions(GetKitItemConditionRequest $request): KitItemConditionViewModel
    {
        return new KitItemConditionViewModel(
            $request->input('model'),
            $request->input('media')
        );
    }
}