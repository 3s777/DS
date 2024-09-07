<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Game\GameDeveloperController;
use App\Http\Controllers\Game\GameGenreController;
use App\Http\Controllers\Game\GameMediaController;
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
                    Route::prefix('admin')->middleware(['auth', 'verified', 'remove.locale'])->group(function () {
                        $this->massDelete('game-medias', GameMediaController::class);
                        Route::resource('game-medias', GameMediaController::class);

                        $this->massDelete('games', GameController::class);
                        Route::get('/select-games', [GameController::class, 'getForSelect'])->name('select-games');
                        Route::resource('games', GameController::class);

                        $this->massDelete('game-developers', GameDeveloperController::class);
                        Route::get('/select-game-developers', [GameDeveloperController::class, 'getForSelect'])->name('select-game-developers');
                        Route::resource('game-developers', GameDeveloperController::class);

                        $this->massDelete('game-publishers', GamePublisherController::class);
                        Route::get('/select-game-publishers', [GamePublisherController::class, 'getForSelect'])->name('select-game-publishers');
                        Route::resource('game-publishers', GamePublisherController::class);

                        $this->massDelete('game-genres', GameGenreController::class);
                        Route::resource('game-genres', GameGenreController::class);

                        $this->massDelete('game-platform-manufacturers', GamePlatformManufacturerController::class);
                        Route::get('/select-game-platform-manufacturers', [GamePlatformManufacturerController::class, 'getForSelect'])->name('select-game-platform-manufacturers');
                        Route::resource('game-platform-manufacturers', GamePlatformManufacturerController::class);

                        $this->massDelete('game-platforms', GamePlatformController::class);
                        Route::resource('game-platforms', GamePlatformController::class);
                    });
                });
            });
    }
}
