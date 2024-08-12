<?php

namespace App\Providers;

use App\Policies\GameDeveloperPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        Gate::before(function ($user, $ability) {
            if ($user->hasRole(config('settings.super_admin_role'))) {
                return true;
            }

            return null;
        });

        Gate::policy(GameDeveloper::class, GameDeveloperPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);

        Model::shouldBeStrict(!app()->isProduction());

        Relation::enforceMorphMap([
            'game' => 'Domain\Game\Models\Game',
            'game_media' => 'Domain\Game\Models\GameMedia',
            'game_developer' => 'Domain\Game\Models\GameDeveloper',
            'game_publisher' => 'Domain\Game\Models\GamePublisher',
            'game_platform' => 'Domain\Game\Models\GamePlatform',
            'game_platform_manufacturer' => 'Domain\Game\Models\GamePlatformManufacturer',
            'user' => 'Domain\Auth\Models\User',
            'permission' => 'Domain\Auth\Models\Permission',
            'role' => 'Domain\Auth\Models\Role',
        ]);

//        Translatable::fallback(
//            fallbackLocale: 'ru',
//        );
    }
}
