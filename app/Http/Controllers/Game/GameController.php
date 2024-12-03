<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameRequest;
use App\Http\Requests\Game\UpdateGameRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\DTOs\FillGameDTO;
use Domain\Game\Models\Game;
use Domain\Game\Services\GameService;
use Domain\Game\ViewModels\GameIndexViewModel;
use Domain\Game\ViewModels\GameUpdateViewModel;
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

class GameController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Game::class, 'game');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.game.index', new GameIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.game.create', new GameUpdateViewModel());
    }

    public function store(CreateGameRequest $request, GameService $gameService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gameService->create(FillGameDTO::fromRequest($request));

        flash()->info(__('game.created'));

        return to_route('games.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Game $game): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.game.edit', new GameUpdateViewModel($game));
    }

    public function update(UpdateGameRequest $request, Game $game, GameService $gameService): RedirectResponse
    {
        $gameService->update($game, FillGameDTO::fromRequest($request));

        flash()->info(__('game.updated'));

        return to_route('games.index');
    }

    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();

        flash()->info(__('game.deleted'));

        return to_route('games.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\Game',
                $request->input('ids')
            )
        );

        flash()->info(__('game.mass_deleted'));

        return to_route('games.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\Game',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('game.mass_force_deleted'));

        return to_route('games.index');
    }

    public function getForSelect(Request $request): AsyncSelectByQueryViewModel
    {
        return new AsyncSelectByQueryViewModel(
            $request->input('query'),
            Game::class,
            trans_choice('game.choose', 2)
        );
    }
}
