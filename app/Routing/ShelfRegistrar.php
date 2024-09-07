<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Shelf\ShelfController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class ShelfRegistrar extends BaseRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function () {
                Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                    Route::prefix('admin')->middleware(['auth', 'verified', 'remove.locale'])->group(function () {
                        $this->massDelete('shelves', ShelfController::class);
                        Route::get('/select-shelves', [ShelfController::class, 'getForSelect'])->name('select-shelves');
                        Route::resource('shelves', ShelfController::class);
                    });
                });
            });
    }
}
