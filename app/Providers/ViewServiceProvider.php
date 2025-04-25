<?php

namespace App\Providers;

use App\View\Composers\AdminSidebarMenuComposer;
use App\View\Composers\FooterMenuComposer;
use App\View\Composers\MainMenuComposer;
use App\View\Composers\MainSubMenuComposer;
use App\View\Composers\ProfileMenuComposer;
use App\View\Composers\RulesMenuComposer;
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
        View::composer('content.rules.menu', RulesMenuComposer::class);
        View::composer('components.common.main-menu', MainMenuComposer::class);
        View::composer('components.common.main-menu', MainSubMenuComposer::class);
        View::composer('components.common.footer', FooterMenuComposer::class);
    }
}
