<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
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

if(!function_exists('get_filter')) {
    function get_filter($filterName)
    {
        return filters()[$filterName];
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
    function sorter($fields, $defaultField, $defaultOrder): Sorter
    {
        return app(
            Sorter::class,
            [
                'columns' => $fields,
                'defaultField' => $defaultField,
                'defaultOrder' => $defaultOrder
            ]
        );
    }
}


if(!function_exists('filterInputName')) {
    function to_dot_name(string $name): string
    {
        return Str::of($name)->replace('[]','')->replace('[', '.')->remove(']')->value();
    }
}
