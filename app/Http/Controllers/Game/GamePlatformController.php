<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGamePlatformRequest;
use App\Http\Requests\Game\UpdateGamePlatformRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\Models\GamePlatform;
use Domain\Game\ViewModels\GamePlatformIndexViewModel;
use Domain\Game\ViewModels\GamePlatformUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;

class GamePlatformController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GamePlatform::class, 'game_platform');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.platform.index', new GamePlatformIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.platform.create', new GamePlatformUpdateViewModel());
    }

    public function store(CreateGamePlatformRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gamePlatform = GamePlatform::create($request->safe()->except(['thumbnail']));

        $gamePlatform->addImageWithThumbnail(
            $request->file('thumbnail'),
            'thumbnail',
            ['small', 'medium']
        );

        flash()->info(__('game_platform.created'));

        return to_route('game-platforms.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GamePlatform $gamePlatform): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.platform.edit', new GamePlatformUpdateViewModel($gamePlatform));
    }

    public function update(UpdateGamePlatformRequest $request, GamePlatform $gamePlatform): RedirectResponse
    {
        $gamePlatform->updateThumbnail($request->file('thumbnail'), $request->input('thumbnail_uploaded'), ['small', 'medium']);

        $gamePlatform->fill($request->safe()->except(['thumbnail', 'thumbnail_uploaded']))->save();

        flash()->info(__('game_platform.updated'));

        return to_route('game-platforms.index');
    }

    public function destroy(GamePlatform $gamePlatform): RedirectResponse
    {
        $gamePlatform->delete();

        flash()->info(__('game_platform.deleted'));

        return to_route('game-platforms.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GamePlatform',
                $request->input('ids')
            )
        );

        flash()->info(__('game_platform.mass_deleted'));

        return to_route('game-platforms.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GamePlatform',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('game_platform.mass_force_deleted'));

        return to_route('game-platforms.index');
    }
}
