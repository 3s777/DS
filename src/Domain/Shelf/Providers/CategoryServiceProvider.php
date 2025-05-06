<?php

namespace Domain\Shelf\Providers;

use Domain\Game\Factories\BookSearchFactory;
use Domain\Game\Factories\GameMediaSearchFactory;
use Domain\Game\Providers\GamesApiServiceProvider;
use Domain\Shelf\Factories\CategorySearchFactory;
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
        $this->app->bind(CategorySearchFactory::class, function (Application $app, array $parameters) {
            return match($parameters['model']) {
                'game_media' => new GameMediaSearchFactory(),
                'test' => new BookSearchFactory()
            };
        });
    }
}
