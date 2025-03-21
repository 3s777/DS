<?php

namespace App\Http\Controllers\Game\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\Admin\CreateGameMediaVariationRequest;
use App\Http\Requests\Game\Admin\FilterGameMediaVariationRequest;
use App\Http\Requests\Game\Admin\UpdateGameMediaVariationRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\DTOs\FillGameMediaVariationDTO;
use Domain\Game\Models\GameMediaVariation;
use Domain\Game\Services\GameMediaVariationService;
use Domain\Game\ViewModels\GameMediaVariationIndexViewModel;
use Domain\Game\ViewModels\GameMediaVariationUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Support\ViewModels\AsyncSelectByQueryViewModel;

class GameMediaVariationController extends Controller
{
    public function __construct()
    {
//        $this->authorizeResource(GameMediaVariation::class, 'game_media_variation');
    }

    public function index(FilterGameMediaVariationRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.variation.index', new GameMediaVariationIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.variation.create', new GameMediaVariationUpdateViewModel());
    }

    public function store(CreateGameMediaVariationRequest $request, GameMediaVariationService $gameMediaService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gameMediaService->create(FillGameMediaVariationDTO::fromRequest($request));

        flash()->info(__('collectible.variation.created'));

        return to_route('admin.game-media-variations.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GameMediaVariation $gameMediaVariation): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.variation.edit', new GameMediaVariationUpdateViewModel($gameMediaVariation));
    }

    public function update(UpdateGameMediaVariationRequest $request, GameMediaVariation $gameMediaVariation, GameMediaVariationService $gameMediaVariationService): RedirectResponse
    {
        $gameMediaVariationService->update($gameMediaVariation, FillGameMediaVariationDTO::fromRequest($request));

        flash()->info(__('collectible.variation.updated'));

        return to_route('admin.game-media-variations.index');
    }

    public function destroy(GameMediaVariation $gameMedia): RedirectResponse
    {
        $gameMedia->delete();

        flash()->info(__('collectible.variation.deleted'));

        return to_route('admin.game-media-variations.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GameMediaVariation',
                $request->input('ids')
            )
        );

        flash()->info(__('collectible.variation.mass_deleted'));

        return to_route('admin.game-media-variations.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GameMediaVariation',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('collectible.variation.mass_force_deleted'));

        return to_route('admin.game-media-variations.index');
    }

    public function getForSelect(Request $request): AsyncSelectByQueryViewModel
    {
        return new AsyncSelectByQueryViewModel(
            $request->input('query'),
            GameMediaVariation::class,
            trans_choice('collectible.variation.choose', 2)
        );
    }
}
