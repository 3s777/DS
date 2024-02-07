<?php

namespace Domain\Game\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Filters\SearchFilter;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Support\Filters\FilterManager;

class GameServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        app(FilterManager::class)->registerFilters([
            new SearchFilter()
        ]);
    }

    public function register(): void
    {
        $this->app->register(
            GamesApiServiceProvider::class
        );

        $this->app->singleton(FilterManager::class);
    }
}
