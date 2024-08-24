<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\View\View;

final class MainMenuComposer
{
    public function compose(View $view): void
    {
        $menu = Menu::make()
            ->add(MenuItem::make('#', trans_choice('common.shelfs', 2)))
            ->add(MenuItem::make('#', __('common.blog')))
            ->add(MenuItem::make(route('feed'), __('common.feed')))
            ->add(MenuItem::make('#', __('common.more'), class: 'main-menu__button-more'))
            ->add(MenuItem::make(route('search'), __('common.add'), class: 'button_submit'));
        $view->with('menu', $menu);
    }
}
