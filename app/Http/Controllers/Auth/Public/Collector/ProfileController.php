<?php

namespace App\Http\Controllers\Auth\Public\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProfileController extends Controller
{
    public function show(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.profile.index');
    }


    public function settings(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.profile.index');
    }
}
