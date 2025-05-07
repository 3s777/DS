<?php

namespace Domain\Shelf\Providers;

use Domain\Game\Factories\BookSearchFactory;
use Domain\Game\Factories\GameMediaSearchFactory;
use Domain\Shelf\Contracts\CategorySearchFactoryContract;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->bind(CategorySearchFactoryContract::class, function (Application $app, array $parameters) {
            return match($parameters['model']) {
                'game_media' => new GameMediaSearchFactory(),
                'test' => new BookSearchFactory()
            };
        });
    }
}
