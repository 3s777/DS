<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameGenreRequest;
use App\Http\Requests\Game\UpdateGameGenreRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\Models\GameGenre;
use Domain\Game\ViewModels\GameGenreIndexViewModel;
use Domain\Game\ViewModels\GameGenreUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;

class GameGenreController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GameGenre::class, 'game_genre');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.genre.index', new GameGenreIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.genre.create', new GameGenreUpdateViewModel());
    }

    public function store(CreateGameGenreRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gameGenre = GameGenre::create($request->safe()->toArray());

        flash()->info(__('game_genre.created'));

        return to_route('game-genres.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GameGenre $gameGenre): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.genre.edit', new GameGenreUpdateViewModel($gameGenre));
    }

    public function update(UpdateGameGenreRequest $request, GameGenre $gameGenre): RedirectResponse
    {

        $gameGenre->fill($request->safe()->toArray())->save();

        flash()->info(__('game_genre.updated'));

        return to_route('game-genres.index');
    }

    public function destroy(GameGenre $gameGenre): RedirectResponse
    {
        $gameGenre->delete();

        flash()->info(__('game_genre.deleted'));

        return to_route('game-genres.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GameGenre',
                $request->input('ids')
            )
        );

        flash()->info(__('game_genre.mass_deleted'));

        return to_route('game-genres.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GameGenre',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('game_genre.mass_force_deleted'));

        return to_route('game-genres.index');
    }
}

