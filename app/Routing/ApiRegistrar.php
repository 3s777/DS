<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Middleware\ApiMiddleware;
use App\Http\Middleware\TokenBlacklistMiddleware;
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
            Route::delete('/authenticate', [AuthenticateController::class, 'logout'])->name('logout')->middleware('auth:jwt', TokenBlacklistMiddleware::class);
            Route::put('/authenticate', [AuthenticateController::class, 'refresh'])->name('refresh');
//            Route::post('/register', AuthenticateController::class)->name('authenticate');
            Route::get('/collectors', [CollectorsController::class, 'index'])
                ->name('collectors.index')
                ->middleware('auth:jwt', TokenBlacklistMiddleware::class);
            Route::get('/collector/{slug}', [CollectorsController::class, 'show'])
                ->name('collectors.show')
                ->middleware('auth:jwt', TokenBlacklistMiddleware::class);

        });

//        Route::get('/test-dump', function() {
//            dump('Test message to Buggregator');
//            dd(['test' => 'array']);
//        });
    }
}
