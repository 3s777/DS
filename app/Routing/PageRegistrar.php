<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Page\Admin\PageCategoryController;
use App\Http\Controllers\Page\Admin\PageController;
use App\Http\Controllers\Page\Public\RulesController;
use App\Http\Controllers\Page\Public\RulesController as PublicPageController;
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
                    ->group(function() {
                        Route::get('/rules/{page:slug}', 'show')->name('rules.show');
                        Route::get('/qa', 'qa')->name('qa');
                    });

            });
    }
}
