<?php

namespace App\Http\Controllers\Game;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameRequest;
use App\Http\Requests\Game\UpdateGameRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\DTOs\CreateGameDTO;
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
        $dto = CreateGameDTO::fromRequest($request);
        dd($dto);

        $game = Game::create($request->safe()->except(['thumbnail', 'genres', 'platforms', 'developers', 'publishers']));

        $game->addImageWithThumbnail(
            $request->file('thumbnail'),
            'thumbnail',
            ['small', 'medium']
        );

        $game->genres()->sync($request->input('genres'));
        $game->platforms()->sync($request->input('platforms'));
        $game->developers()->sync($request->input('developers'));
        $game->publishers()->sync($request->input('publishers'));

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
        $game->updateThumbnail(
            $request->file('thumbnail'),
            $request->input('thumbnail_uploaded'),
            ['small', 'medium']
        );

        $game->fill($request->safe()->except(['thumbnail', 'thumbnail_uploaded', 'genres', 'platforms', 'developers', 'publishers']))->save();

        $game->genres()->sync($request->input('genres'));
        $game->platforms()->sync($request->input('platforms'));
        $game->developers()->sync($request->input('game_developers'));
        $game->publishers()->sync($request->input('game_publishers'));

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