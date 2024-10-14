<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Shelf\CollectibleController;
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
                    ->middleware(['auth', 'verified', 'remove.locale'])
                    ->group(function () {
                    Route::prefix('admin')->group(function () {
                        $this->massDelete('shelves', ShelfController::class);
                        Route::post('/select-shelves', [ShelfController::class, 'getForSelect'])->name('select-shelves');
                        Route::resource('shelves', ShelfController::class);
                    });

                    Route::prefix('admin')->group(function () {
                        $this->massDelete('collectibles', CollectibleController::class);
                        Route::get('/select-collectibles', [CollectibleController::class, 'getForSelect'])->name('select-collectibles');
                        Route::resource('collectibles', CollectibleController::class);
                    });

                    Route::prefix('admin')->group(function () {
                        $this->massDelete('kit-items', KitItemController::class);
                        Route::resource('kit-items', KitItemController::class);
                    });
                });
            });
    }
}
