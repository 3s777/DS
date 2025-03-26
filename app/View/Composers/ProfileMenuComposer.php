<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\View\View;

final class ProfileMenuComposer
{
    public function compose(View $view): void
    {
        $menu = Menu::make()
            ->add(MenuItem::make(route('profile'), __('common.statistic'), 'statistic'))
            ->add(MenuItem::make(route('profile.settings'), trans_choice('settings.settings', 2), 'profile'))
            ->add(MenuItem::make(route('home'), __('common.confidential'), 'statistic'));

        $view->with('menu', $menu);
    }
}
