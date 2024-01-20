<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameDeveloperRequest;
use App\Http\Requests\Game\UpdateGameDeveloperRequest;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class GameDeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $developers = GameDeveloper::all();

        return view('admin.game.developer.index', compact(['developers']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.game.developer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGameDeveloperRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $createGameDeveloperData = $request->validated();

        GameDeveloper::create($createGameDeveloperData);

        flash()->info(__('Разработчик добавлен'));

        return redirect(route('game-developers.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GameDeveloper $gameDeveloper)
    {
        return view('admin.game.developer.edit', compact(['gameDeveloper']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameDeveloperRequest $request, GameDeveloper $gameDeveloper)
    {
        $updateGameDeveloperData = $request->validated();

        $gameDeveloper->fill($updateGameDeveloperData)->save();

        flash()->info(__('Разработчик обновлен'));

        return redirect(route('game-developers.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
