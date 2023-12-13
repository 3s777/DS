<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DomainServiseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(
            \Domain\Auth\Providers\AuthServiceProvider::class
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
