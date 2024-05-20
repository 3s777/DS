<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Game\GameDeveloperController;
use App\Http\Controllers\Game\GamePublisherController;
use App\Http\Controllers\HomeController;
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


                    Route::get('/findUsers{query?}', [UserController::class, 'getUsers'])->name('find-users');


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

                        Route::delete('/game-developers/delete-selected', [GameDeveloperController::class, 'deleteSelected'])->name('game-developers.delete');
                        Route::delete('/game-developers/force-delete-selected', [GameDeveloperController::class, 'forceDeleteSelected'])->name('game-developers.forceDelete');
                        Route::resource('game-developers', GameDeveloperController::class)
//                    ->parameters([
//                        'game-developers' => 'gameDeveloper:slug'
//                    ])
                            ->middleware(['remove.locale']);
                        Route::resource('game-publishers', GamePublisherController::class)
                            ->middleware(['remove.locale']);

                    });

                });
            });
    }
}
