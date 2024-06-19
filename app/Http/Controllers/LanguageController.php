<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\FilterGameDeveloperRequest;
use App\Models\Language;

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

