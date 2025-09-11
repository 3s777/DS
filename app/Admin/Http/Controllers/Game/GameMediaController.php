<?php

namespace App\Admin\Http\Controllers\Game;

use Admin\Game\DTOs\FillGameMediaDTO;
use Admin\Game\Services\GameMediaService;
use Admin\Game\ViewModels\GameMediaIndexViewModel;
use Admin\Game\ViewModels\GameMediaUpdateViewModel;
use App\Admin\Http\Requests\Game\CreateGameMediaRequest;
use App\Admin\Http\Requests\Game\FilterGameMediaRequest;
use App\Admin\Http\Requests\Game\UpdateGameMediaRequest;
use App\Http\Controllers\Controller;
use Domain\Game\Models\GameMedia;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Support\MassDeletingRequest;
use Support\ViewModels\AsyncSelectByQueryViewModel;

class GameMediaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GameMedia::class, 'game_media');
    }

    public function index(FilterGameMediaRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
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

        flash()->info(__('game.media.created'));

        return to_route('admin.game-medias.index');
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

        flash()->info(__('game.media.updated'));

        return to_route('admin.game-medias.index');
    }

    public function destroy(GameMedia $gameMedia): RedirectResponse
    {
        $gameMedia->delete();

        flash()->info(__('game.media.deleted'));

        return to_route('admin.game-medias.index');
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

        flash()->info(__('game.media.mass_deleted'));

        return to_route('admin.game-medias.index');
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

        flash()->info(__('game.media.mass_force_deleted'));

        return to_route('admin.game-medias.index');
    }

    public function getForSelect(Request $request): AsyncSelectByQueryViewModel
    {
        return new AsyncSelectByQueryViewModel(
            $request->input('query'),
            GameMedia::class,
            trans_choice('game.media.choose', 2)
        );
    }
}
