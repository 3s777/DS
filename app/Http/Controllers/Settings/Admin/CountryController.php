<?php

namespace App\Http\Controllers\Settings\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Admin\CreateCountryRequest;
use App\Http\Requests\Settings\Admin\UpdateCountryRequest;
use Domain\Settings\DTOs\FillCountryDTO;
use Domain\Settings\Models\Country;
use Domain\Settings\Services\CountryService;
use Domain\Settings\ViewModels\CountryIndexViewModel;
use Domain\Settings\ViewModels\CountryUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Support\ViewModels\AsyncSelectByQueryViewModel;

class CountryController extends Controller
{
    public function __construct()
    {
        //        $this->authorizeResource(KitItem::class, 'kit-item');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.settings.country.index', new CountryIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.settings.country.create');
    }

    public function store(CreateCountryRequest $request, CountryService $countryService): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $countryService->create(FillCountryDTO::fromRequest($request));

        flash()->info(__('settings.country.created'));

        return to_route('admin.countries.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Country $country): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.settings.country.edit', new CountryUpdateViewModel($country));
    }

    public function update(UpdateCountryRequest $request, Country $country, CountryService $countryService): RedirectResponse
    {
        $countryService->update($country, FillCountryDTO::fromRequest($request));

        flash()->info(__('settings.country.updated'));

        return to_route('admin.countries.index');
    }

    public function destroy(Country $country): RedirectResponse
    {
        $country->delete();

        flash()->info(__('settings.country.deleted'));

        return to_route('admin.countries.index');
    }


    public function getForSelect(Request $request): AsyncSelectByQueryViewModel
    {
        return new AsyncSelectByQueryViewModel(
            $request->input('query'),
            Game::class,
            trans_choice('game.choose', 2)
        );
    }
}
