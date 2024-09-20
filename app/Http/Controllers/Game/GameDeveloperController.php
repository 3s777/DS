<?php

namespace App\Http\Controllers\Game;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameDeveloperRequest;
use App\Http\Requests\Game\FilterGameDeveloperRequest;
use App\Http\Requests\Game\UpdateGameDeveloperRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\ViewModels\GameDeveloperUpdateViewModel;
use Domain\Game\ViewModels\GameDeveloperIndexViewModel;
use Domain\Game\ViewModels\GameDeveloperListSelectViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\ViewModels\AsyncSelectViewModel;

class GameDeveloperController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GameDeveloper::class, 'game_developer');
    }

    public function index(FilterGameDeveloperRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.developer.index', new GameDeveloperIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $developer = GameDeveloper::first();

//        $this->authorize('view', $developer);

//        if(auth()->user()->cannot('view', $developer)) {
//            abort(403);
//        }

        return view('admin.game.developer.create', new GameDeveloperUpdateViewModel());
    }

    public function store(CreateGameDeveloperRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gameDeveloper = GameDeveloper::create($request->safe()->except(['thumbnail']));

        $gameDeveloper->addImageWithThumbnail(
            $request->file('thumbnail'),
            'thumbnail',
            ['small', 'medium']
        );

        flash()->info(__('game_developer.created'));

        return to_route('game-developers.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GameDeveloper $gameDeveloper): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.developer.edit', new GameDeveloperUpdateViewModel($gameDeveloper));
    }

    public function update(UpdateGameDeveloperRequest $request, GameDeveloper $gameDeveloper): RedirectResponse
    {
        $gameDeveloper->updateThumbnail($request->file('thumbnail'), $request->input('thumbnail_uploaded'), ['small', 'medium']);

        $gameDeveloper->fill($request->safe()->except(['thumbnail', 'thumbnail_uploaded']))->save();

        flash()->info(__('game_developer.updated'));

        return to_route('game-developers.index');
    }

    public function destroy(GameDeveloper $gameDeveloper): RedirectResponse
    {
        $gameDeveloper->delete();

        flash()->info(__('game_developer.deleted'));

        return to_route('game-developers.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GameDeveloper',
                $request->input('ids')
            )
        );

        flash()->info(__('game_developer.mass_deleted'));

        return to_route('game-developers.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GameDeveloper',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('game_developer.mass_force_deleted'));

        return to_route('game-developers.index');
    }

    public function getForSelect(Request $request): AsyncSelectViewModel
    {
        return new AsyncSelectViewModel(
            $request->input('query'),
            GameDeveloper::class,
            trans_choice('game_developer.choose', 2),
            'all.*',
        );
    }
}

