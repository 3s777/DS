<?php

namespace Domain\Shelf\Providers;

use Domain\Game\Factories\GameMediaSearchFactory;
use Domain\Game\Providers\GamesApiServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ShelfServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->register(
            CategoryServiceProvider::class
        );
    }
}
