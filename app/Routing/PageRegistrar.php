<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Page\Admin\PageController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class PageRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::as('admin.')->prefix('{locale}')
                    ->whereIn('locale', config('app.available_locales'))
                    ->group(function () {
                        Route::prefix('admin')
                            ->middleware(['auth', 'verified', 'remove.locale'])
                            ->group(function () {
                                Route::resource('pages', PageController::class);
                            });
                    });

            });
    }
}
