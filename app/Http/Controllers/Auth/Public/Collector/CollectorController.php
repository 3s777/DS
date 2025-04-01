<?php

namespace App\Http\Controllers\Auth\Public\Collector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Collector\UpdateCollectorProfileRequest;
use Domain\Auth\DTOs\UpdateCollectorProfileDTO;
use Domain\Auth\Services\CollectorProfileService;
use Domain\Auth\ViewModels\Public\CollectorProfileSettingsViewModel;
use Domain\Auth\ViewModels\Public\CollectorProfileViewModel;
use Domain\Auth\ViewModels\Public\CollectorsViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;


class CollectorController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.users.index', new CollectorsViewModel());
    }
}
