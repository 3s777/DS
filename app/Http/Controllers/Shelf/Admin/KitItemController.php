<?php

namespace App\Http\Controllers\Shelf\Admin;

use Admin\Shelf\DTOs\FillKitItemDTO;
use Admin\Shelf\Services\KitItemService;
use Admin\Shelf\ViewModels\KitItemConditionViewModel;
use Admin\Shelf\ViewModels\KitItemIndexViewModel;
use Admin\Shelf\ViewModels\KitItemUpdateViewModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shelf\Admin\CreateKitItemRequest;
use App\Http\Requests\Shelf\Admin\GetKitItemConditionRequest;
use App\Http\Requests\Shelf\Admin\UpdateKitItemRequest;
use Domain\Shelf\Models\KitItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Support\MassDeletingRequest;

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

        return to_route('admin.kit-items.index');
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

        return to_route('admin.kit-items.index');
    }

    public function destroy(KitItem $kitItem): RedirectResponse
    {
        $kitItem->delete();

        flash()->info(__('collectible.kit.deleted'));

        return to_route('admin.kit-items.index');
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

        return to_route('admin.kit-items.index');
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

        return to_route('admin.kit-items.index');
    }

    public function getHtmlConditions(GetKitItemConditionRequest $request): KitItemConditionViewModel
    {
        return new KitItemConditionViewModel(
            $request->input('model'),
            $request->input('media')
        );
    }
}
