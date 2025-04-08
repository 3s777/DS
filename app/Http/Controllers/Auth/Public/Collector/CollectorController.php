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
        return view('content.collector.index', compact('collector'));
    }

    public function showCollection(Collector $collector)
    {
        return view('content.collector.collection', compact('collector'));
    }

    public function showSale(Collector $collector)
    {
        return view('content.collector.sale', compact('collector'));
    }

    public function showAuction(Collector $collector)
    {
        return view('content.collector.auction', compact('collector'));
    }

    public function showWishlist(Collector $collector)
    {
        return view('content.collector.wishlist', compact('collector'));
    }

    public function showExchange(Collector $collector)
    {
        return view('content.collector.exchange', compact('collector'));
    }

    public function showBlog(Collector $collector)
    {
        return view('content.collector.blog', compact('collector'));
    }
}
