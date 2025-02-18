<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Settings\Admin\CountryController;
use App\Http\Controllers\Settings\ColorThemeController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class SettingRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::get('/set-theme/{theme}', ColorThemeController::class)->name('set.theme')->middleware(['remove.locale']);
                    Route::post('/select-countries', [CountryController::class, 'getForSelect'])->name('select-countries');
                });

                Route::as('admin.')->prefix('{locale}')
                    ->whereIn('locale', config('app.available_locales'))
                    ->group(function () {
                        Route::prefix('admin')
                            ->middleware(['auth', 'verified', 'remove.locale'])
                            ->group(function () {
                                Route::resource('countries', CountryController::class);
                            });
                    });

            });
    }
}
