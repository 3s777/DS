<?php

namespace App\Routing;

use App\Admin\Http\Controllers\Game\GameController;
use App\Admin\Http\Controllers\Game\GameDeveloperController;
use App\Admin\Http\Controllers\Game\GameGenreController;
use App\Admin\Http\Controllers\Game\GameMediaController;
use App\Admin\Http\Controllers\Game\GameMediaVariationController;
use App\Admin\Http\Controllers\Game\GamePlatformController;
use App\Admin\Http\Controllers\Game\GamePlatformManufacturerController;
use App\Admin\Http\Controllers\Game\GamePublisherController;
use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Game\GameMediaVariationController as PublicVariationController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class GameRegistrar extends BaseRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::post('/select-game-developers', [GameDeveloperController::class, 'getForSelect'])->name('select-game-developers');
                    Route::post('/select-game-publishers', [GamePublisherController::class, 'getForSelect'])->name('select-game-publishers');
                    Route::post('/select-game-media', [GameMediaController::class, 'getForSelect'])->name('game-media.select');
                    Route::post('/select-game-media-variation', [GameMediaVariationController::class, 'getForSelect'])->name('game-media-variation.select');
                    Route::post('/select-game-variation-by-media', [GameMediaVariationController::class, 'getForSelectByMedia'])->name('media.game-variation.select');

                    Route::post('/select-games', [GameController::class, 'getForSelect'])->name('select-games');
                });

                Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::controller(PublicVariationController::class)
                        ->middleware(['remove.locale'])
                        ->group(function () {
                            Route::get('/game/variation/{game_media_variation}', 'show')->name('game.variation.show');
                        });
                });

                Route::as('admin.')->prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::prefix('admin')->middleware(['auth:admin', 'verified', 'remove.locale'])->group(function () {
                        $this->massDelete('game-medias', GameMediaController::class);
                        Route::resource('game-medias', GameMediaController::class);

                        $this->massDelete('game-media-variations', GameMediaVariationController::class);
                        Route::resource('game-media-variations', GameMediaVariationController::class);

                        $this->massDelete('games', GameController::class);
                        Route::post('/games-autocomplete', [GameController::class, 'getForAutocomplete'])->name('games-autocomplete');
                        Route::resource('games', GameController::class);

                        $this->massDelete('game-developers', GameDeveloperController::class);
                        Route::resource('game-developers', GameDeveloperController::class);

                        $this->massDelete('game-publishers', GamePublisherController::class);
                        Route::resource('game-publishers', GamePublisherController::class);

                        $this->massDelete('game-genres', GameGenreController::class);
                        Route::resource('game-genres', GameGenreController::class);

                        $this->massDelete('game-platform-manufacturers', GamePlatformManufacturerController::class);
                        Route::resource('game-platform-manufacturers', GamePlatformManufacturerController::class);

                        $this->massDelete('game-platforms', GamePlatformController::class);
                        Route::resource('game-platforms', GamePlatformController::class);
                    });
                });
            });
    }
}
