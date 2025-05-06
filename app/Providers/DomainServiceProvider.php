<?php

namespace App\Providers;

use Domain\Auth\Providers\AuthServiceProvider;
use Domain\Game\Providers\GameServiceProvider;
use Domain\Shelf\Providers\ShelfServiceProvider;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(
            AuthServiceProvider::class
        );

        $this->app->register(
            GameServiceProvider::class
        );

        $this->app->register(
            ShelfServiceProvider::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
