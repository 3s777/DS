<?php

namespace App\Routing;

use Illuminate\Support\Facades\Route;

class BaseRouteRegistrar
{
    public function massDelete(string $name, string $controller): void
    {
        Route::delete('/'.$name.'/delete-selected', [$controller, 'deleteSelected'])
            ->name($name.'.delete');
        Route::delete('/'.$name.'/force-delete-selected', [$controller, 'forceDeleteSelected'])
            ->name($name.'.forceDelete');
    }
}
