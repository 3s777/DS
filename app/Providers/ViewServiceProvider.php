<?php

namespace App\Providers;

use App\View\Composers\AdminSidebarMenuComposer;
use App\View\Composers\MainMenuComposer;
use App\View\Composers\ProfileMenuComposer;
use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Vite::macro('image', fn ($asset) => $this->asset("resources/images/$asset"));

        View::composer('admin.menu', AdminSidebarMenuComposer::class);
        View::composer('content.profile.menu', ProfileMenuComposer::class);
        View::composer('components.common.main-menu', MainMenuComposer::class);
    }
}
