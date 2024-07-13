<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Game\GameDeveloperController;
use App\Http\Controllers\Game\GameGenreController;
use App\Http\Controllers\Game\GamePlatformController;
use App\Http\Controllers\Game\GamePlatformManufacturerController;
use App\Http\Controllers\Game\GamePublisherController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class GameRegistrar extends BaseRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
                        $this->massDelete('games', GameController::class);
                        Route::resource('games', GameController::class)
                            ->middleware(['remove.locale']);

                        $this->massDelete('game-developers', GameDeveloperController::class);
                        Route::get('/select-game-developers', [GameDeveloperController::class, 'getForSelect'])->name('select-game-developers');
                        Route::resource('game-developers', GameDeveloperController::class)
                            ->middleware(['remove.locale']);

                        $this->massDelete('game-publishers', GamePublisherController::class);
                        Route::get('/select-game-publishers', [GamePublisherController::class, 'getForSelect'])->name('select-game-publishers');
                        Route::resource('game-publishers', GamePublisherController::class)
                            ->middleware(['remove.locale']);

                        $this->massDelete('game-genres', GameGenreController::class);
                        Route::resource('game-genres', GameGenreController::class)
                            ->middleware(['remove.locale']);

                        $this->massDelete('game-platform-manufacturers', GamePlatformManufacturerController::class);
                        Route::get('/get-manufacturers', [GamePlatformManufacturerController::class, 'getManufacturers'])->name('get-manufacturers');
                        Route::resource('game-platform-manufacturers', GamePlatformManufacturerController::class)
                            ->middleware(['remove.locale']);

                        $this->massDelete('game-platforms', GamePlatformController::class);
                        Route::resource('game-platforms', GamePlatformController::class)
                            ->middleware(['remove.locale']);
                    });
                });
            });
    }
}
