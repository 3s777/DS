<?php

namespace App\Routing;

use App\Admin\Http\Controllers\Page\PageCategoryController;
use App\Admin\Http\Controllers\Page\PageController;
use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Page\RulesController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class PageRegistrar extends BaseRouteRegistrar implements RouteRegistrar
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
                                $this->massDelete('page-categories', PageCategoryController::class);
                                Route::resource('page-categories', PageCategoryController::class);
                            });
                    });

                Route::prefix('{locale}')
                    ->whereIn('locale', config('app.available_locales'))
                    ->middleware(['remove.locale'])
                    ->controller(RulesController::class)
                    ->group(function () {
                        Route::get('/rules/{page}', 'show')->name('rules.show');
                        Route::get('/qa', 'qa')->name('qa');
                    });

            });
    }
}
