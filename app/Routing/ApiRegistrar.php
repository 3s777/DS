<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\CollectorsController;

final class ApiRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->as('api.')->middleware(ApiMiddleware::class)->group(function () {
            Route::post('/authenticate', [AuthenticateController::class, 'authenticate'])->name('authenticate');
            Route::delete('/authenticate', [AuthenticateController::class, 'logout'])->name('logout')->middleware('auth:jwt');
//            Route::post('/register', AuthenticateController::class)->name('authenticate');
            Route::get('/collectors', [CollectorsController::class, 'collectorsindex'])->name('collectorsindex');
            Route::get('/collector/{slug}', [CollectorsController::class, 'collectorsshow'])->name('collectorsshow');

        });
    }
}
