<?php

namespace App\Http\Controllers;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameDeveloperRequest;
use App\Http\Requests\Game\FilterGameDeveloperRequest;
use App\Http\Requests\Game\UpdateGameDeveloperRequest;
use App\Http\Requests\MassDeletingRequest;
use App\Models\Language;
use App\ViewModels\Game\GameDeveloperCrudViewModel;
use App\ViewModels\Game\GameDeveloperIndexViewModel;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;

class LanguageController extends Controller
{
    public function index(FilterGameDeveloperRequest $request)
    {
        $lang = Language::get()->first();

        if(auth()->user()->cannot('create', Language::class)) {
            abort(403);
        }

        return 'Hello world';
    }
}

