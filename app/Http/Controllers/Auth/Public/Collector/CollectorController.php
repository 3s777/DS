<?php

namespace App\Http\Controllers\Auth\Public\Collector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Collector\UpdateCollectorProfileRequest;
use Domain\Auth\DTOs\UpdateCollectorProfileDTO;
use Domain\Auth\Models\Collector;
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
        return view('content.collector.search', new CollectorsViewModel());
    }

    public function show(Collector $collector)
    {
        dd($collector);
    }

    public function showCollection(Collector $collector)
    {
        dd($collector);
    }

    public function showSale(Collector $collector)
    {
        dd($collector);
    }

    public function showAuction(Collector $collector)
    {
        dd($collector);
    }

    public function showWishlist(Collector $collector)
    {
        dd($collector);
    }

    public function showExchange(Collector $collector)
    {
        dd($collector);
    }

    public function showBlog(Collector $collector)
    {
        dd($collector);
    }
}
