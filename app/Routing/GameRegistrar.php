<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Game\GameDeveloperController;
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
                    });
                });
            });
    }
}
