<?php

namespace App\Http\Controllers\Game\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\Admin\CreateGamePublisherRequest;
use App\Http\Requests\Game\Admin\FilterGamePublisherRequest;
use App\Http\Requests\Game\Admin\UpdateGamePublisherRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\Models\GamePublisher;
use Domain\Game\ViewModels\GamePublisherIndexViewModel;
use Domain\Game\ViewModels\GamePublisherUpdateViewModel;
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
        return view('admin.game.publisher.create', new GamePublisherUpdateViewModel());
    }

    public function store(CreateGamePublisherRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gamePublisher = GamePublisher::create($request->safe()->except(['featured_image']));

        $gamePublisher->addFeaturedImageWithThumbnail(
            $request->file('featured_image'),
            ['small', 'medium']
        );

        flash()->info(__('game.publisher.created'));

        return to_route('admin.game-publishers.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GamePublisher $gamePublisher): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.publisher.edit', new GamePublisherUpdateViewModel($gamePublisher));
    }

    public function update(UpdateGamePublisherRequest $request, GamePublisher $gamePublisher): RedirectResponse
    {
        $gamePublisher->updateFeaturedImage($request->file('featured_image'), $request->input('featured_image_uploaded'), ['small', 'medium']);

        $gamePublisher->fill($request->safe()->except(['featured_image', 'featured_image_uploaded']))->save();

        flash()->info(__('game.publisher.updated'));

        return to_route('admin.game-publishers.index');
    }

    public function destroy(GamePublisher $gamePublisher): RedirectResponse
    {
        $gamePublisher->delete();

        flash()->info(__('game.publisher.deleted'));

        return to_route('admin.game-publishers.index');
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

        flash()->info(__('game.publisher.mass_deleted'));

        return to_route('admin.game-publishers.index');
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

        flash()->info(__('game.publisher.mass_force_deleted'));

        return to_route('admin.game-publishers.index');
    }

    public function getForSelect(Request $request): AsyncSelectByQueryViewModel
    {
        return new AsyncSelectByQueryViewModel(
            $request->input('query'),
            GamePublisher::class,
            trans_choice('game.publisher.choose', 2)
        );
    }
}
