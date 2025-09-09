<?php

namespace App\Http\Controllers\Shelf\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shelf\Admin\FilterCollectibleRequest;
use App\Http\Requests\Shelf\Admin\GetCollectibleMediaRequest;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\ViewModels\CollectibleIndexViewModel;
use Domain\Shelf\ViewModels\CollectibleMediaViewModel;
use Domain\Shelf\ViewModels\CollectibleUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Support\MassDeletingRequest;

class CollectibleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Collectible::class, 'collectible');
    }

    public function index(FilterCollectibleRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        //        $models = Collectible::query()->where(DB::raw('("sale"->>\'price\')::int'),'<',10000)->get();
        return view('admin.shelf.collectible.index', new CollectibleIndexViewModel());
    }

    //    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    //    {
    //        return view('admin.shelf.collectible.create', new CollectibleUpdateViewModel());
    //    }
    //
    //    public function store(CreateCollectibleRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    //    {
    //        $collectibleService->create(FillCollectibleDTO::fromRequest($request));
    //
    //        flash()->info(__('collectible.created'));
    //
    //        return to_route('collectibles.index');
    //    }
    //
    //    public function show(string $id)
    //    {
    //    }

    public function edit(Collectible $collectible): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $class = Relation::getMorphedModel($collectible->collectable->getMorphClass());
        $type = strtolower(CollectibleTypeEnum::tryFrom($class)->name);
        return view('admin.shelf.collectible.'.$type.'.edit', new CollectibleUpdateViewModel($collectible));
    }

    //    public function update(UpdateCollectibleRequest $request, Collectible $collectible, CollectibleService $collectibleService): RedirectResponse
    //    {
    //        $collectibleService->update($collectible, FillCollectibleDTO::fromRequest($request));
    //
    //        flash()->info(__('collectible.updated'));
    //
    //        return to_route('collectibles.index');
    //    }

    public function destroy(Collectible $collectible): RedirectResponse
    {
        $collectible->delete();

        flash()->info(__('collectible.deleted'));

        return to_route('admin.collectibles.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                Collectible::class,
                $request->input('ids')
            )
        );

        flash()->info(__('collectible.mass_deleted'));

        return to_route('admin.collectibles.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                Collectible::class,
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('collectible.mass_force_deleted'));

        return to_route('admin.collectibles.index');
    }

    public function getMediaForSelect(GetCollectibleMediaRequest $request): string|CollectibleMediaViewModel
    {
        return new CollectibleMediaViewModel(
            $request->input('query')
        );
    }
}
