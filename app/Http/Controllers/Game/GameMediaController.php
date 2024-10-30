<?php

namespace App\Http\Controllers\Game;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameMediaRequest;
use App\Http\Requests\Game\UpdateGameMediaRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\DTOs\FillGameMediaDTO;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameMedia;
use Domain\Game\Services\GameMediaService;
use Domain\Game\ViewModels\GameMediaUpdateViewModel;
use Domain\Game\ViewModels\GameMediaIndexViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Support\ViewModels\AsyncSelectByQueryViewModel;

class GameMediaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GameMedia::class, 'game_media');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.media.index', new GameMediaIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.media.create', new GameMediaUpdateViewModel());
    }

    public function store(CreateGameMediaRequest $request, GameMediaService $gameMediaService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gameMediaService->create(FillGameMediaDTO::fromRequest($request));

        flash()->info(__('game_media.created'));

        return to_route('game-medias.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GameMedia $gameMedia): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.media.edit', new GameMediaUpdateViewModel($gameMedia));
    }

    public function update(UpdateGameMediaRequest $request, GameMedia $gameMedia, GameMediaService $gameMediaService): RedirectResponse
    {
        $gameMediaService->update($gameMedia, FillGameMediaDTO::fromRequest($request));

        flash()->info(__('game_media.updated'));

        return to_route('game-medias.index');
    }

    public function destroy(GameMedia $gameMedia): RedirectResponse
    {
        $gameMedia->delete();

        flash()->info(__('game_media.deleted'));

        return to_route('game-medias.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GameMedia',
                $request->input('ids')
            )
        );

        flash()->info(__('game_media.mass_deleted'));

        return to_route('game-medias.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GameMedia',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('game_media.mass_force_deleted'));

        return to_route('game-medias.index');
    }

    public function getForSelect(Request $request): AsyncSelectByQueryViewModel
    {
        return new AsyncSelectByQueryViewModel(
            $request->input('query'),
            GameMedia::class,
            trans_choice('game_media.choose', 2)
        );
    }
}
