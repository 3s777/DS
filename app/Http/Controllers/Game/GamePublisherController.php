<?php

namespace App\Http\Controllers\Game;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGamePublisherRequest;
use App\Http\Requests\Game\FilterGamePublisherRequest;
use App\Http\Requests\Game\UpdateGamePublisherRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\Models\GamePublisher;
use Domain\Game\ViewModels\GamePublisherCrudViewModel;
use Domain\Game\ViewModels\GamePublisherIndexViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;

class GamePublisherController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GamePublisher::class, 'game_publisher');
    }

    public function index(FilterGamePublisherRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.publisher.index', new GamePublisherIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $publisher = GamePublisher::first();

        return view('admin.game.publisher.create', new GamePublisherCrudViewModel());
    }

    public function store(CreateGamePublisherRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gamePublisher = GamePublisher::create($request->safe()->except(['thumbnail']));

        $gamePublisher->addImageWithThumbnail(
            $request->file('thumbnail'),
            'thumbnail',
            ['small', 'medium']
        );

        flash()->info(__('game_publisher.created'));

        return to_route('game-publishers.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GamePublisher $gamePublisher): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.publisher.edit', new GamePublisherCrudViewModel($gamePublisher));
    }

    public function update(UpdateGamePublisherRequest $request, GamePublisher $gamePublisher): RedirectResponse
    {
        $gamePublisher->updateThumbnail($request->file('thumbnail'), $request->input('thumbnail_uploaded'), ['small', 'medium']);

        $gamePublisher->fill($request->safe()->except(['thumbnail', 'thumbnail_uploaded']))->save();

        flash()->info(__('game_publisher.updated'));

        return to_route('game-publishers.index');
    }

    public function destroy(GamePublisher $gamePublisher): RedirectResponse
    {
        $gamePublisher->delete();

        flash()->info(__('game_publisher.deleted'));

        return to_route('game-publishers.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GamePublisher',
                $request->input('ids')
            )
        );

        flash()->info(__('game_publisher.mass_deleted'));

        return to_route('game-publishers.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GamePublisher',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('game_publisher.mass_force_deleted'));

        return to_route('game-publishers.index');
    }
}

