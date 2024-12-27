<?php

namespace App\Http\Controllers\Shelf;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shelf\CreateCollectibleGameRequest;
use App\Http\Requests\Shelf\UpdateCollectibleGameRequest;
use Domain\Shelf\DTOs\FillCollectibleDTO;
use Domain\Shelf\Services\CollectibleService;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\ViewModel\CollectibleUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CollectibleGameController extends Controller
{
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.collectible.game.create', new CollectibleUpdateViewModel());
    }

    public function store(CreateCollectibleGameRequest $request, CollectibleService $collectibleService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $collectibleService->create(FillCollectibleDTO::fromRequest($request));

        flash()->info(__('collectible.created'));

        return to_route('collectibles.index');
    }

    public function update(UpdateCollectibleGameRequest $request, Collectible $collectible, CollectibleService $collectibleService): RedirectResponse
    {
        $collectibleService->update($collectible, FillCollectibleDTO::fromRequest($request));

        flash()->info(__('collectible.updated'));

        return to_route('collectibles.index');
    }
}
