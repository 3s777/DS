<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateDeveloperRequest;
use Domain\Game\Models\Developer;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $developers = Developer::all();

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
    public function store(CreateDeveloperRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $data = $request->validated();

        $developer = Developer::create($data);

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
        $developer = Developer::where('slug', $slug)->first();

        return view('admin.game.developer.edit', compact(['developer']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
