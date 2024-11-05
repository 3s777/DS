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
                ->setLabel(trans_choice('shelf.shelves', 2))
                ->setIcon('game')
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('shelf.shelves', 2))
                    ->add(MenuItem::make(route('shelves.create'), __('common.add')))
                    ->add(MenuItem::make(route('shelves.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('collectible.collectibles', 2))
//                    ->add(MenuItem::make(route('collectibles.create'), __('common.add')))
                    ->add(MenuItem::make(route('collectibles.create.game'), __('game.add')))
                    ->add(MenuItem::make(route('collectibles.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('collectible.kit.items', 2))
                    ->add(MenuItem::make(route('kit-items.create'), __('common.add')))
                    ->add(MenuItem::make(route('kit-items.index'), __('common.list')))
                )
            )
            ->add(MenuGroup::make()
                ->setLabel(trans_choice('game.games', 2))
                ->setIcon('game')
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('game_media.medias', 2))
                    ->add(MenuItem::make(route('game-medias.create'), __('common.add')))
                    ->add(MenuItem::make(route('game-medias.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('game.games', 2))
                    ->add(MenuItem::make(route('games.create'), __('common.add')))
                    ->add(MenuItem::make(route('games.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('game_developer.developers', 2))
                    ->add(MenuItem::make(route('game-developers.create'), __('common.add')))
                    ->add(MenuItem::make(route('game-developers.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('game_publisher.publishers', 2))
                    ->add(MenuItem::make(route('game-publishers.create'), __('common.add')))
                    ->add(MenuItem::make(route('game-publishers.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('game_genre.genres', 2))
                    ->add(MenuItem::make(route('game-genres.create'), __('common.add')))
                    ->add(MenuItem::make(route('game-genres.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('game_platform.platforms', 2))
                    ->add(MenuItem::make(route('game-platforms.create'), __('common.add')))
                    ->add(MenuItem::make(route('game-platforms.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('game_platform_manufacturer.manufacturers', 2))
                    ->add(MenuItem::make(route('game-platform-manufacturers.create'), __('common.add')))
                    ->add(MenuItem::make(route('game-platform-manufacturers.index'), __('common.list')))
                )
            )
            ->add(MenuGroup::make()
                ->setLabel(trans_choice('user.users', 2))
                ->setIcon('users')
                ->add(MenuItem::make(route('users.create'), __('common.add')))
                ->add(MenuItem::make(route('users.index'), __('common.list')))
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('role.roles', 2))
                    ->add(MenuItem::make(route('roles.create'), __('common.add')))
                    ->add(MenuItem::make(route('roles.index'), __('common.list')))
                )
                ->add(MenuGroup::make()
                    ->setLabel(trans_choice('permission.permissions', 2))
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
