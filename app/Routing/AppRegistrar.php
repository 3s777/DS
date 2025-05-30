<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\DocumentationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {

        Route::middleware('web')
            ->group(function () {

                Route::get('/{locale?}', HomeController::class)->whereIn('locale', config('app.available_locales'))->name('home');

                Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {

                    Route::get('/ui', function () {
                        return view('content.ui.index');
                    })->name('ui');

                    Route::view('/game-carrier', 'content.game-carrier.index')
                        ->name('game-carrier');

                    Route::get('/feed', function () {
                        return view('content.feed.index');
                    })->name('feed');

                    Route::get('/search', function () {
                        return view('content.search.index');
                    })->name('search');

                    Route::get('/demo-select', [PageController::class, 'demoSelect'])->name('demo-select');

                    Route::get('/test-admin', function () {
                        return view('content.page.qa');
                    })->middleware('auth:admin')->name('admin.test-admin');

                    Route::get('/test-collector', function () {
                        return view('content.page.qa');
                    })->middleware('auth:collector')->name('test-collector');

                });
            });
    }
}
