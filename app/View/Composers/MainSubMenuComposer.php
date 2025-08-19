<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Illuminate\View\View;

final class MainSubMenuComposer
{
    public function compose(View $view): void
    {
        $subMenu = Menu::make()
            ->add(MenuItem::make(route('collectors'), trans_choice('user.collectors', 2), 'users', description: 'Найти других коллекционеров'))
            ->add(MenuItem::make(route('collectors'), trans_choice('user.collectors', 2), 'users', description: 'Найти других коллекционеров'))
            ->add(MenuItem::make(route('collectors'), trans_choice('user.collectors', 2), 'users', description: 'Найти других коллекционеров'))
            ->add(MenuItem::make(route('admin.login'), 'Админка', 'profile', description: 'Войти в административную панель'));
        $view->with('subMenu', $subMenu);
    }
}
