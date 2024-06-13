<?php

namespace App\Providers;

use App\Policies\GameDeveloperPolicy;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Translatable\Facades\Translatable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(GameDeveloper::class, GameDeveloperPolicy::class);

        Model::shouldBeStrict(!app()->isProduction());
//        Translatable::fallback(
//            fallbackLocale: 'ru',
//        );
    }
}
