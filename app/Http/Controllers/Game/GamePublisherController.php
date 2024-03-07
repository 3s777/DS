<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGamepublisherRequest;
use App\Http\Requests\Game\UpdateGamepublisherRequest;
use App\ViewModels\GamepublisherViewModel;
use Domain\Game\Models\Gamepublisher;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class GamePublisherController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.game.publisher.index', new GamePublisherViewModel());
    }

    public function create()
    {
        return view('admin.game.publisher.create');
    }

    public function store(CreateGamePublisherRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        GamePublisher::create($request->validated());

        flash()->info(__('game.publisher.created'));

        return to_route('game-publishers.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Gamepublisher $gamePublisher)
    {
        return view('admin.game.publisher.edit', compact('gamePublisher'));
    }

    public function update(UpdateGamePublisherRequest $request, Gamepublisher $gamePublisher)
    {
        $gamePublisher->fill($request->validated())->save();

        flash()->info(__('game.publisher.updated'));

        return to_route('game-publishers.index');
    }

    public function destroy(Gamepublisher $gamePublisher)
    {
        $gamePublisher->delete();

        flash()->info(__('game.publisher.deleted'));

        return to_route('game-publishers.index');
    }
}
