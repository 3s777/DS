<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameDeveloperRequest;
use App\Http\Requests\Game\FilterGameDeveloperRequest;
use App\Http\Requests\Game\UpdateGameDeveloperRequest;
use App\Models\Language;
use App\ViewModels\GameDeveloperViewModel;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Throwable;

class GameDeveloperController extends Controller
{
    public function index(FilterGameDeveloperRequest $request)
    {
        return view('admin.game.developer.index', new GameDeveloperViewModel());
    }

    public function create()
    {
        return view('admin.game.developer.create');
    }

    public function store(CreateGameDeveloperRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $gameDeveloper = GameDeveloper::create($request->safe()->except(['thumbnail']));

        $gameDeveloper->addImageWithThumbnail(
            $request->file('thumbnail'),
            'thumbnail',
            ['small', 'medium']
        );

        flash()->info(__('game.developer.created'));

        return to_route('game-developers.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GameDeveloper $gameDeveloper)
    {
        return view('admin.game.developer.edit', compact('gameDeveloper'));
    }

    public function update(UpdateGameDeveloperRequest $request, GameDeveloper $gameDeveloper)
    {
        $gameDeveloper->updateThumbnail($request->file('thumbnail'), $request->input('thumbnail_uploaded'), ['small', 'medium']);

        $gameDeveloper->fill($request->safe()->except(['thumbnail', 'thumbnail_uploaded']))->save();

        flash()->info(__('game.developer.updated'));

        return to_route('game-developers.index');
    }

    public function destroy(GameDeveloper $gameDeveloper)
    {
        $gameDeveloper->forceDelete();

        flash()->info(__('game.developer.deleted'));

        return to_route('game-developers.index');
    }

    public function deleteSelected(Request $request)
    {
        $selectedIds = explode(",", '6,2.5,7,5');
        try {
            foreach ($selectedIds as $id) {

                if (is_numeric($id)) {

                    GameDeveloper::where('id', $id)->delete();
                }
            }
        }
                     catch (Throwable $e) {
report($e);
flash()->danger(__('game.developer.updated'));

return to_route('game-developers.index');

}

        flash()->info(__('game.developer.updated'));

        return to_route('game-developers.index');
    }
}
