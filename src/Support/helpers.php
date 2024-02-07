<?php

use Support\Filters\FilterManager;
use Support\Flash\Flash;

if(!function_exists('flash')) {
    function flash(): Flash
    {
        return app(Flash::class);
    }
}

if(!function_exists('filters')) {
    function filters(): array
    {
        return app(FilterManager::class)->items();
    }
}

if(!function_exists('filter_url')) {
    function filter_url(array $params = []): string
    {
        return route('game-developers.index', [
            ...request()->only(['filters', 'sort', 'order']),
            ...$params,
        ]);
    }
}

//if(!function_exists('sorter')) {
//    function sorter(): Sorter
//    {
//        return app(Sorter::class);
//    }
//}
