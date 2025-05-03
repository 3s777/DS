<?php

declare(strict_types=1);

namespace App\Routing\Api;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\Auth\Public\AuthenticateController;
use App\Http\Controllers\Api\Auth\Public\CollectorsController;
use App\Http\Middleware\JwtGuardMiddleware;
use App\Http\Middleware\TokenBlacklistMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class ApiRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('api')->prefix('api')->as('api.')->middleware(JwtGuardMiddleware::class)->group(function () {
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
