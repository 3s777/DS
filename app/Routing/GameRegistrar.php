<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Game\GameDeveloperController;
use App\Http\Controllers\Game\GameGenreController;
use App\Http\Controllers\Game\GamePlatformController;
use App\Http\Controllers\Game\GamePlatformManufacturerController;
use App\Http\Controllers\Game\GamePublisherController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class GameRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
                        Route::delete('/game-developers/delete-selected', [GameDeveloperController::class, 'deleteSelected'])
                            ->name('game-developers.delete');
                        Route::delete('/game-developers/force-delete-selected', [GameDeveloperController::class, 'forceDeleteSelected'])
                            ->name('game-developers.forceDelete');
                        Route::resource('game-developers', GameDeveloperController::class)
                            ->middleware(['remove.locale']);

                        Route::delete('/game-publishers/delete-selected', [GamePublisherController::class, 'deleteSelected'])
                            ->name('game-publishers.delete');
                        Route::delete('/game-publishers/force-delete-selected', [GamePublisherController::class, 'forceDeleteSelected'])
                            ->name('game-publishers.forceDelete');
                        Route::resource('game-publishers', GamePublisherController::class)
                            ->middleware(['remove.locale']);

                        Route::delete('/game-genres/delete-selected', [GameGenreController::class, 'deleteSelected'])
                            ->name('game-genres.delete');
                        Route::delete('/game-genres/force-delete-selected', [GameGenreController::class, 'forceDeleteSelected'])
                            ->name('game-genres.forceDelete');
                        Route::resource('game-genres', GameGenreController::class)
                            ->middleware(['remove.locale']);

                        Route::delete('/game-platform-manufacturers/delete-selected', [GamePlatformManufacturerController::class, 'deleteSelected'])
                            ->name('game-platform-manufacturers.delete');
                        Route::delete('/game-platform-manufacturers/force-delete-selected', [GamePlatformManufacturerController::class, 'forceDeleteSelected'])
                            ->name('game-platform-manufacturers.forceDelete');
                        Route::resource('game-platform-manufacturers', GamePlatformManufacturerController::class)
                            ->middleware(['remove.locale']);

                        Route::delete('/game-platforms/delete-selected', [GamePlatformController::class, 'deleteSelected'])
                            ->name('game-platforms.delete');
                        Route::delete('/game-platforms/force-delete-selected', [GamePlatformController::class, 'forceDeleteSelected'])
                            ->name('game-platforms.forceDelete');
                        Route::resource('game-platforms', GamePlatformController::class)
                            ->middleware(['remove.locale']);
                    });
                });
            });
    }
}
