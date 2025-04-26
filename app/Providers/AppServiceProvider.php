<?php

namespace App\Providers;

use App\Guards\JWTGuard;
use Domain\Auth\JWT;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\Policies\GameDeveloperPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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

        //Ручная регистрация полиций laravel 11
        //Gate::policy(GameDeveloper::class, GameDeveloperPolicy::class);

        Model::shouldBeStrict(!app()->isProduction());

        Relation::enforceMorphMap([
            'shelf' => 'Domain\Shelf\Models\Shelf',
            'game' => 'Domain\Game\Models\Game',
            'game_media' => 'Domain\Game\Models\GameMedia',
            'game_media_variation' => 'Domain\Game\Models\GameMediaVariation',
            'game_developer' => 'Domain\Game\Models\GameDeveloper',
            'game_publisher' => 'Domain\Game\Models\GamePublisher',
            'game_platform' => 'Domain\Game\Models\GamePlatform',
            'game_platform_manufacturer' => 'Domain\Game\Models\GamePlatformManufacturer',
            'user' => 'Domain\Auth\Models\User',
            'collector' => 'Domain\Auth\Models\Collector',
            'permission' => 'Domain\Auth\Models\Permission',
            'role' => 'Domain\Auth\Models\Role',
            'kit_item' => 'Domain\Shelf\Models\KitItem',
            'collectable' => 'Domain\Shelf\Models\Collectible',
            'category' => 'Domain\Shelf\Models\Category',
            'sale' => 'Domain\Trade\Models\Sale',
            'auction' => 'Domain\Trade\Models\Auction',
            'page' => 'Domain\Page\Models\Page',
            'page_category' => 'Domain\Page\Models\PageCategory',
        ]);

        //        Translatable::fallback(
        //            fallbackLocale: 'ru',
        //        );

        $this->app->instance(JWT::class, new JWT(
            config('auth.jwt_secret')
        ));

        Auth::extend('jwt', function (Application $app, string $name, array $config) {
            return new JWTGuard(
                $app[JWT::class],
                Auth::createUserProvider($config['provider']),
                $app['request']
            );
        });
    }
}
