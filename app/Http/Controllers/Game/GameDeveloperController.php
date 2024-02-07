<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameDeveloperRequest;
use App\Http\Requests\Game\FilterGameDeveloperRequest;
use App\Http\Requests\Game\UpdateGameDeveloperRequest;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class GameDeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = GameDeveloper::query()
            ->select(['id', 'name', 'slug'])->filtered()->sorted();
//        $query->when($request->input('sort'), function (Builder $query) use ($request) {
//            $query->orderBy($request->input('sort'), $request->input('order'));
//        });

        $developers = $query->paginate(4)->withQueryString();


//        $developers = GameDeveloper::select(['id', 'name', 'slug'])->orderby('id')->paginate(5);

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
        GameDeveloper::create($request->validated());

        flash()->info(__('game.developer.created'));

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
        $gameDeveloper->fill($request->validated())->save();

        flash()->info(__('game.developer.updated'));

        return redirect(route('game-developers.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameDeveloper $gameDeveloper)
    {
        $gameDeveloper->delete();

        flash()->info(__('game.developer.deleted'));

        return redirect(route('game-developers.index'));
    }

    public function atest(Request $request){

        $developers = GameDeveloper::select(['id', 'name', 'slug'])->orderby('id')->get();



        if($request->sort){
            return response()->json([
                ['id' => 1, 'name' => 'bob', 'age' => '123'],
            ]);
        }
        return response()->json($developers);
    }
}
