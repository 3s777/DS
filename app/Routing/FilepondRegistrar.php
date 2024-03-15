<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\FilePondController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class FilepondRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function() {
                Route::post('filepond/process', [FilePondController::class, 'upload'])->name('filepond.upload');
                Route::delete('filepond/process', [FilePondController::class, 'delete'])->name('filepond.delete');
            });
    }
}
