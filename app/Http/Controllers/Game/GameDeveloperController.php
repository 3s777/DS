<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameDeveloperRequest;
use App\Http\Requests\Game\FilterGameDeveloperRequest;
use App\Http\Requests\Game\UpdateGameDeveloperRequest;
use App\ViewModels\GameDeveloperViewModel;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

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

        if(!$request->input('thumbnail_selected') && !$request->file('thumbnail')) {
            $thumbnailMedia = $gameDeveloper->getFirstMedia('thumbnail');
            $gameDeveloper->deleteAllThumbnails($thumbnailMedia);
        }

        $gameDeveloper->fill($request->safe()->except(['thumbnail', 'thumbnail_selected']))->save();

        flash()->info(__('game.developer.updated'));

        return to_route('game-developers.index');
    }

    public function destroy(GameDeveloper $gameDeveloper)
    {
        $gameDeveloper->forceDelete();

        flash()->info(__('game.developer.deleted'));

        return to_route('game-developers.index');
    }
}
