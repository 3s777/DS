<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGamePlatformManufacturerRequest;
use App\Http\Requests\Game\UpdateGamePlatformManufacturerRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\Models\GamePlatformManufacturer;
use Domain\Game\ViewModels\GamePlatformManufacturerIndexViewModel;
use Domain\Game\ViewModels\GamePlatformManufacturerUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;

class GamePlatformManufacturerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GamePlatformManufacturer::class, 'game_platform_manufacturer');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.platform-manufacturer.index', new GamePlatformManufacturerIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.platform-manufacturer.create', new GamePlatformManufacturerUpdateViewModel());
    }

    public function store(CreateGamePlatformManufacturerRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gamePlatformManufacturer = GamePlatformManufacturer::create($request->safe()->except(['thumbnail']));

        $gamePlatformManufacturer->addImageWithThumbnail(
            $request->file('thumbnail'),
            'thumbnail',
            ['small', 'medium']
        );

        flash()->info(__('game_platform_manufacturer.created'));

        return to_route('game-platform-manufacturers.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GamePlatformManufacturer $gamePlatformManufacturer): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.game.platform-manufacturer.edit', new GamePlatformManufacturerUpdateViewModel($gamePlatformManufacturer));
    }

    public function update(UpdateGamePlatformManufacturerRequest $request, GamePlatformManufacturer $gamePlatformManufacturer): RedirectResponse
    {
        $gamePlatformManufacturer->updateThumbnail($request->file('thumbnail'), $request->input('thumbnail_uploaded'), ['small', 'medium']);

        $gamePlatformManufacturer->fill($request->safe()->except(['thumbnail', 'thumbnail_uploaded']))->save();

        flash()->info(__('game_platform_manufacturer.updated'));

        return to_route('game-platform-manufacturers.index');
    }

    public function destroy(GamePlatformManufacturer $gamePlatformManufacturer): RedirectResponse
    {
        $gamePlatformManufacturer->delete();

        flash()->info(__('game_platform_manufacturer.deleted'));

        return to_route('game-platform-manufacturers.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GamePlatformManufacturer',
                $request->input('ids')
            )
        );

        flash()->info(__('game_platform_manufacturer.mass_deleted'));

        return to_route('game-platform-manufacturers.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Game\Models\GamePlatformManufacturer',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('game_platform_manufacturer.mass_force_deleted'));

        return to_route('game-platform-manufacturers.index');
    }
}

