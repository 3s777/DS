<?php

namespace App\Http\Controllers\Game\Admin;

use Admin\Game\ViewModels\GamePlatformIndexViewModel;
use Admin\Game\ViewModels\GamePlatformUpdateViewModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\Admin\CreateGamePlatformRequest;
use App\Http\Requests\Game\Admin\UpdateGamePlatformRequest;
use Domain\Game\Models\GamePlatform;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Support\MassDeletingRequest;

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
        $gamePlatform = GamePlatform::create($request->safe()->except(['featured_image']));

        $gamePlatform->addFeaturedImageWithThumbnail(
            $request->file('featured_image'),
            ['small', 'medium']
        );

        flash()->info(__('game.platform.created'));

        return to_route('admin.game-platforms.index');
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
        $gamePlatform->updateFeaturedImage($request->file('featured_image'), $request->input('featured_image_uploaded'), ['small', 'medium']);

        $gamePlatform->fill($request->safe()->except(['featured_image', 'featured_image_uploaded']))->save();

        flash()->info(__('game.platform.updated'));

        return to_route('admin.game-platforms.index');
    }

    public function destroy(GamePlatform $gamePlatform): RedirectResponse
    {
        $gamePlatform->delete();

        flash()->info(__('game.platform.deleted'));

        return to_route('admin.game-platforms.index');
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

        flash()->info(__('game.platform.mass_deleted'));

        return to_route('admin.game-platforms.index');
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

        flash()->info(__('game.platform.mass_force_deleted'));

        return to_route('admin.game-platforms.index');
    }
}
