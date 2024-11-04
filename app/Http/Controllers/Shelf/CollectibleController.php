<?php

namespace App\Http\Controllers\Shelf;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeletingRequest;
use App\Http\Requests\Shelf\CreateCollectibleRequest;
use App\Http\Requests\Shelf\GetCollectibleMediaRequest;
use App\Http\Requests\Shelf\UpdateCollectibleRequest;
use Domain\Shelf\DTOs\FillCollectibleDTO;
use Domain\Shelf\Services\CollectibleService;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\ViewModel\CollectibleIndexViewModel;
use Domain\Shelf\ViewModel\CollectibleMediaViewModel;
use Domain\Shelf\ViewModel\CollectibleUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Domain\Shelf\Enums\CollectibleTypeEnum;

class CollectibleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Collectible::class, 'collectible');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.collectible.index', new CollectibleIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.collectible.create', new CollectibleUpdateViewModel());
    }

//    public function store(CreateCollectibleRequest $request, CollectibleService $collectibleService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    public function store(CreateCollectibleRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application

    {

        $collectibleService->create(FillCollectibleDTO::fromRequest($request));

        flash()->info(__('collectible.created'));

        return to_route('collectibles.index');
    }

    public function show(string $id)
    {
        dd('sdf');
    }

    public function edit(Collectible $collectible): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $type = strtolower(CollectibleTypeEnum::tryFrom($collectible->collectable_type)->name);
        return view('admin.shelf.collectible.'.$type.'.edit', new CollectibleUpdateViewModel($collectible));
    }

    public function update(UpdateCollectibleRequest $request, Collectible $collectible, CollectibleService $collectibleService): RedirectResponse
    {
        $collectibleService->update($collectible, FillCollectibleDTO::fromRequest($request));

        flash()->info(__('collectible.updated'));

        return to_route('collectibles.index');
    }

    public function destroy(Collectible $collectible): RedirectResponse
    {
        $collectible->delete();

        flash()->info(__('collectible.deleted'));

        return to_route('collectibles.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Collectible\Models\Collectible',
                $request->input('ids')
            )
        );

        flash()->info(__('collectible.mass_deleted'));

        return to_route('collectibles.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Collectible\Models\Collectible',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('collectible.mass_force_deleted'));

        return to_route('collectibles.index');
    }

    public function getMediaForSelect(GetCollectibleMediaRequest $request): string|CollectibleMediaViewModel
    {
        return new CollectibleMediaViewModel(
            $request->input('query')
        );
    }

    public function getMedia(Request $request)
    {
        $modelClass = CollectibleTypeEnum::{$request->input('model')}->value;
        $modelName = CollectibleTypeEnum::{$request->input('model')}->name;
        $media = $modelClass::find($request->input('media'));

        $html = '';

        foreach($media->kitItems as $kitItem) {
//            $html .= ViewFacade::make("components.ui.star-rating")
//                ->with('name', $kitItem->slug)
//                ->with('title', $kitItem->name);

//            $html .= view('components.ui.star-rating',
//                ['name' => $kitItem->slug,
//                'title' => $kitItem->name]
//            );
            $html .= Blade::render(
                '<x-ui.star-rating :name="$name" :title="$title" input-name="kit_conditions[{{ $name }}]" class="admin__conditions-item" />',
                ['name' => $kitItem->id, 'title' => $kitItem->name]
            );
        }

        return $html;
    }
}
