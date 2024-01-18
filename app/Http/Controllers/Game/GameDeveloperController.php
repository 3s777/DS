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
        $data = $request->validated();

        $developer = GameDeveloper::create($data);

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
    public function edit(string $slug)
    {
        $developer = GameDeveloper::where('slug', $slug)->first();

        return view('admin.game.developer.edit', compact(['developer']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameDeveloperRequest $request, string $id)
    {
        $data = $request->validated();

        $developer = GameDeveloper::find($id);

        $developer->fill($data)->save();

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
