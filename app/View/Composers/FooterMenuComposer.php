<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Illuminate\View\View;

final class FooterMenuComposer
{
    public function compose(View $view): void
    {
        $footerMenu = Menu::make()
            ->add(MenuItem::make('#', 'О проекте'))
            ->add(MenuItem::make('#', 'Правила сайта'))
            ->add(MenuItem::make('#', 'Вопрос-ответ'))
            ->add(MenuItem::make('#', 'Справка/Помощь'))
            ->add(MenuItem::make('#', 'Контакты'))
            ->add(MenuItem::make('#', 'Техническая поддержка'));
        $view->with('menu', $footerMenu);
    }
}
