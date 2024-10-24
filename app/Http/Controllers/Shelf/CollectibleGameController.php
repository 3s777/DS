<?php

namespace App\Http\Controllers\Shelf;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeletingRequest;
use App\Http\Requests\Shelf\CreateCollectibleGameRequest;
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
use Illuminate\Support\Facades\Validator;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;

class CollectibleGameController extends Controller
{

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.collectible.game.create', new CollectibleUpdateViewModel());
    }

//    public function store(CreateCollectibleRequest $request, CollectibleService $collectibleService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    public function store(CreateCollectibleGameRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        dd($request);
        $collectibleService->create(FillCollectibleDTO::fromRequest($request));

        flash()->info(__('collectible.created'));

        return to_route('collectibles.index');
    }

    public function edit(Collectible $collectible): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.shelf.collectible.edit', new CollectibleUpdateViewModel($collectible));
    }

    public function update(UpdateCollectibleRequest $request, Collectible $collectible, CollectibleService $collectibleService): RedirectResponse
    {
        $collectibleService->update($collectible, FillCollectibleDTO::fromRequest($request));

        flash()->info(__('collectible.updated'));

        return to_route('collectibles.index');
    }
}
