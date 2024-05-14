<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Support\Filters\FilterManager;
use Support\Sorters\Sorter;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FilterManager::class);

        $this->app->bind(Sorter::class, function (Application $app, array $params) {
            return new Sorter($params['columns'], $params['defaultField'], $params['defaultOrder']);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //        app(FilterManager::class)->registerFilters([
        //            new SearchFilter(),
        //            new DatesFilter()
        //        ]);
    }
}
