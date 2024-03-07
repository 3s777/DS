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
        GameDeveloper::create($request->validated());

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
        $gameDeveloper->fill($request->validated())->save();

        flash()->info(__('game.developer.updated'));

        return to_route('game-developers.index');
    }

    public function destroy(GameDeveloper $gameDeveloper)
    {
        $gameDeveloper->delete();

        flash()->info(__('game.developer.deleted'));

        return to_route('game-developers.index');
    }

    public function atest(Request $request)
    {
        $developers = GameDeveloper::select(['id', 'name', 'slug'])->orderby('id')->get();

        if($request->sort){
            return response()->json([
                ['id' => 1, 'name' => 'bob', 'age' => '123'],
            ]);
        }
        return response()->json($developers);
    }
}
