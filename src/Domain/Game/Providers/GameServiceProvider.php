<?php

namespace Domain\Game\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class GameServiceProvider extends ServiceProvider
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
            GamesApiServiceProvider::class
        );
    }
}
