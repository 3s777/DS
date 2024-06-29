<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Illuminate\View\View;

final class AdminSidebarMenuComposer
{
    public function compose(View $view): void
    {
        $menu = Menu::make()
            ->add(MenuItem::make(route('home'), __('common.statistic'), 'statistic'))
            ->add(MenuItem::make(route('users.show', ['user' => auth()->user()->slug ]), __('user.profile'), 'profile'))
            ->add(MenuGroup::make()
                ->setLabel('Игры')
                ->setIcon('game')
                ->add(MenuGroup::make()
                    ->setLabel(__('game_developer.developers'))
                    ->add(MenuItem::make(route('game-developers.create'), __('common.add')))
                    ->add(MenuItem::make(route('game-developers.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel('Издатели')
                    ->add(MenuItem::make(route('game-publishers.create'), __('common.add')))
                    ->add(MenuItem::make(route('game-publishers.index'), __('common.list')))
                )
            )
            ->add(MenuGroup::make()
                ->setLabel(__('user.users'))
                ->setIcon('users')
                ->add(MenuItem::make(route('users.create'), __('common.add')))
                ->add(MenuItem::make(route('users.index'), __('common.list')))
                ->add(MenuGroup::make()
                    ->setLabel(__('role.roles'))
                    ->add(MenuItem::make(route('roles.create'), __('common.add')))
                    ->add(MenuItem::make(route('roles.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(__('permission.permissions'))
                    ->add(MenuItem::make(route('permissions.create'), __('common.add')))
                    ->add(MenuItem::make(route('permissions.index'), __('common.list')))
                )
            );

            $view->with('menu', $menu);


//                $array = [
//            ['link' => route('home'), 'label' => 'Статистика', 'icon' => 'statistic'],
//            ['link' => route('users.show', ['user' => auth()->user()->slug ]), 'label' => 'Профиль', 'icon' => ''],
//            [
//                'link' => '', 'label' => 'Игры', 'icon' => 'game',
//                'group' => [
//                    [
//                        'link' => '', 'label' => 'Разработчики', 'icon' => '',
//                        'group' => [
//                            ['link' => route('game-developers.create'), 'label' => 'Добавить',],
//                            ['link' => route('game-developers.index'), 'label' => 'Список',],
//                        ]
//                    ],
//                    [
//                        'link' => '', 'label' => 'Издатели', 'icon' => '',
//                        'group' => [
//                            ['link' => route('game-publishers.create'), 'label' => 'Добавить',],
//                            ['link' => route('game-publishers.index'), 'label' => 'Список',],
//                        ]
//                    ],
//                ]
//            ],
//            ['link' => '', 'label' => 'Пользователи', 'icon' => 'users',
//                'group' => [
//                    ['link' => route('users.create'), 'label' => 'Добавить',],
//                    ['link' => route('users.index'), 'label' => 'Список',],
//                    [
//                        'link' => '', 'label' => 'Роли', 'icon' => '',
//                        'group' => [
//                            ['link' => route('roles.create'), 'label' => 'Добавить',],
//                            ['link' => route('roles.index'), 'label' => 'Список',],
//                        ]
//                    ],
//                    [
//                        'link' => '', 'label' => 'Разрешения', 'icon' => '',
//                        'group' => [
//                            ['link' => route('permissions.create'), 'label' => 'Добавить',],
//                            ['link' => route('permissions.index'), 'label' => 'Список',],
//                        ]
//                    ],
//                ]
//            ],
//        ];
//
//        $menu = Menu::createFromArray($array);
//
//        $view->with('menu', $menu);
    }
}
