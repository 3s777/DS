<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\View\View;

final class NavigationComposer
{
    public function compose(View $view): void
    {
        $menu = Menu::make()
            ->add(MenuItem::make(route('home'), 'Статистика', 'statistic'))
            ->add(MenuItem::make(route('users.show', ['user' => auth()->user()->slug ]), 'Профиль', 'profile'))
            ->add(MenuGroup::make()
                ->setLabel('Игры')
                ->setIcon('game')
                ->add(MenuGroup::make()
                    ->setLabel('Разработчики')
                    ->add(MenuItem::make(route('game-developers.create'), 'Добавить'))
                    ->add(MenuItem::make(route('game-developers.index'), 'Список'))
                )
                ->add(MenuGroup::make()
                    ->setLabel('Издатели')
                    ->add(MenuItem::make(route('game-publishers.create'), 'Добавить'))
                    ->add(MenuItem::make(route('game-publishers.index'), 'Список'))
                )
//                ->add(MenuItem::make(route('home'), 'Главная'))
//                ->add(MenuItem::make(route('users.create'), 'Пользователи1'))
//                ->add(MenuItem::make(route('users.index'), 'Пользователи2'))
//                ->add(MenuItem::make(route('users.create'), 'Пользователи3'))
            )
            ->add(MenuGroup::make()
                ->setLabel('Пользователи')
                ->setIcon('profile')
                ->add(MenuItem::make(route('users.create'), 'Добавить'))
                ->add(MenuItem::make(route('users.index'), 'Список'))
                ->add(MenuGroup::make()
                    ->setLabel('Роли')
                    ->add(MenuItem::make(route('roles.create'), 'Добавить'))
                    ->add(MenuItem::make(route('roles.index'), 'Список'))
                )
                ->add(MenuGroup::make()
                    ->setLabel('Разрешения')
                    ->add(MenuItem::make(route('permissions.create'), 'Добавить'))
                    ->add(MenuItem::make(route('permissions.index'), 'Список'))
                )
            );
//            ->addIf(true, MenuItem::make(route('game-developers.index'), 'Каталог'));
        $view->with('menu', $menu);
    }
}
