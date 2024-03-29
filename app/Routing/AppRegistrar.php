<?php

namespace App\Routing;


use App\Contracts\RouteRegistrar;
use App\Http\Controllers\FilePondController;
use App\Http\Controllers\Game\GameDeveloperController;
use App\Http\Controllers\Game\GamePublisherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThumbnailController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::get('/storage/images/{dir}/{method}/{size}/{file}', ThumbnailController::class)
            ->where('method', 'resize|crop|cover')
            ->where('size', '\d+x\d+')
            ->where('file', '.+\.(png|jpg|jpeg|webp)$')
            ->name('thumbnail');

        Route::middleware('web')
            ->group(function() {

                Route::get('/{locale?}', HomeController::class)->name('home');

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

            Route::get('/users', [UserController::class, 'index'])->name('users');

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

                Route::resource('game-developers', GameDeveloperController::class)
//                    ->parameters([
//                        'game-developers' => 'gameDeveloper:slug'
//                    ])
                    ->middleware(['remove.locale']);
                Route::get('/game-developer/atest', [GameDeveloperController::class, 'atest'])->name('atest');
                Route::resource('game-publishers', GamePublisherController::class)
                    ->middleware(['remove.locale']);

            });

        });
    });
    }
}
