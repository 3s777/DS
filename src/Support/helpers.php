<?php

use Illuminate\Support\Facades\Route;
use Support\Sorters\Sorter;
use Support\Filters\FilterManager;
use Support\Flash\Flash;

if(!function_exists('flash')) {
    function flash(): Flash
    {
        return app(Flash::class);
    }
}

if(!function_exists('filters')) {
    function filters($availableFilters = []): array
    {
        if(!empty($availableFilters)) {
            return app(FilterManager::class)
                ->registerFilters($availableFilters)
                ->items();
        }

        return app(FilterManager::class)->items();
    }
}

if(!function_exists('filter_url')) {
    function filter_url(array $params = []): string
    {
        return route(Route::currentRouteName(), [
            ...request()->only(['filters', 'sort', 'order']),
            ...$params,
        ]);
    }
}

if(!function_exists('sorter')) {
    function sorter($fields): Sorter
    {
        return app(Sorter::class, $fields);
    }
}
