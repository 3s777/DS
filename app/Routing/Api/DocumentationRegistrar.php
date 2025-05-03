<?php

declare(strict_types=1);

namespace App\Routing\Api;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Api\DocumentationController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class DocumentationRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::prefix('{locale}')->whereIn('locale', config('app.available_locales'))->group(function () {
                Route::controller(DocumentationController::class)->group(function () {
                    Route::get('/api/v1/documentation', 'showDocV1')->name('api.v1.docs');
                    Route::get('/api/v1/openapi.yaml', 'contentV1')->name('openapi.v1.yaml');
                })->middleware('auth');
            });
        });
    }
}
