<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Shelf\CollectibleController;
use App\Http\Controllers\Shelf\CollectibleGameController;
use App\Http\Controllers\Shelf\KitItemController;
use App\Http\Controllers\Shelf\ShelfController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class ShelfRegistrar extends BaseRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::prefix('{locale}')
                    ->whereIn('locale', config('app.available_locales'))
                    ->group(function () {
                        Route::prefix('admin')
                        ->middleware(['auth', 'verified', 'remove.locale'])
                        ->group(function () {
                            $this->massDelete('shelves', ShelfController::class);
                            Route::post('/shelves/select/list', [ShelfController::class, 'getForSelect'])->name('shelves.select');
                            Route::resource('shelves', ShelfController::class);

                            $this->massDelete('collectibles', CollectibleController::class);
                            Route::post('/collectibles/select/media', [CollectibleController::class, 'getMediaForSelect'])->name('collectibles.select.media');
                            Route::post('/collectibles/get/html-kit-conditions', [CollectibleController::class, 'getHtmlKitConditions'])->name('collectibles.get.html-kit-conditions');
                            Route::get('/collectibles/create/game', [CollectibleGameController::class, 'create'])->name('collectibles.create.game');
                            Route::post('/collectibles/store/game', [CollectibleGameController::class, 'store'])->name('collectibles.store.game');
                            Route::put('/collectibles/update/game/{collectible}', [CollectibleGameController::class, 'update'])->name('collectibles.update.game');

                            Route::resource('collectibles', CollectibleController::class)
                                ->except(['create', 'store', 'update', 'show']);

                            $this->massDelete('kit-items', KitItemController::class);
                            Route::resource('kit-items', KitItemController::class);
                        });
                    });
            });
    }
}
