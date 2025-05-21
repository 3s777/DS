<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Game\Admin\GameController;
use App\Http\Controllers\Game\Admin\GameDeveloperController;
use App\Http\Controllers\Game\Admin\GameGenreController;
use App\Http\Controllers\Game\Admin\GameMediaController;
use App\Http\Controllers\Game\Admin\GameMediaVariationController;
use App\Http\Controllers\Game\Admin\GamePlatformController;
use App\Http\Controllers\Game\Admin\GamePlatformManufacturerController;
use App\Http\Controllers\Game\Admin\GamePublisherController;
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
                    Route::post('/select-games', [GameController::class, 'getForSelect'])->name('select-games');
                });

                Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::controller(PublicCategoryController::class)
                        ->middleware(['remove.locale'])
                        ->group(function () {
                            Route::get('/category/{category}', 'show')->name('category.show');
                            Route::get('/category/{category}/variations', 'variations')->name('category.variations');
                        });
                });

                Route::as('admin.')->prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::prefix('admin')->middleware(['auth', 'verified', 'remove.locale'])->group(function () {
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
