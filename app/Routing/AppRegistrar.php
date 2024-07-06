<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ColorThemeController;
use App\Http\Controllers\Game\GameDeveloperController;
use App\Http\Controllers\Game\GamePublisherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
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


                    Route::get('/lang', [LanguageController::class, 'index'])->name('lang');

                    Route::get('/set-theme/{theme}', ColorThemeController::class)->name('set.theme')->middleware(['remove.locale']);;

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




                    Route::get('/profile', function () {
                        return view('content.profile.index');
                    })->name('profile');

                    Route::get('/rules', function () {
                        return view('content.page.index');
                    })->name('rules');

                    Route::get('/qa', function () {
                        return view('content.page.qa');
                    })->name('qa');

                    Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
                        Route::get('/', function () {
                            return view('admin.index');
                        })->name('admin');
                    });
                });
            });
    }
}
