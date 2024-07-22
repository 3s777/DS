<?php

namespace App\Http\Controllers\Game;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameRequest;
use App\Http\Requests\Game\UpdateGameRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\Models\Game;
use Domain\Game\ViewModels\GameCrudViewModel;
use Domain\Game\ViewModels\GameIndexViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;

class GameController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Game::class, 'game');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.index', new GameIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.create', new GameCrudViewModel());
    }

    public function store(CreateGameRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $game = Game::create($request->safe()->except(['thumbnail']));

        $game->addImageWithThumbnail(
            $request->file('thumbnail'),
            'thumbnail',
            ['small', 'medium']
        );

        $game->genres()->attach($request->input('genres'));
        $game->platforms()->attach($request->input('platforms'));
        $game->developers()->attach($request->input('game_developers'));
        $game->publishers()->attach($request->input('game_publishers'));

        flash()->info(__('game.created'));

        return to_route('games.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Game $game): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.edit', new GameCrudViewModel($game));
    }

    public function update(UpdateGameRequest $request, Game $game): RedirectResponse
    {
        dd($request);
        $game->updateThumbnail($request->file('thumbnail'), $request->input('thumbnail_uploaded'), ['small', 'medium']);

        $game->fill($request->safe()->except(['thumbnail', 'thumbnail_uploaded']))->save();

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
}
