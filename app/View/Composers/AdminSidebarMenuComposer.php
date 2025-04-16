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
            ->add(
                MenuItem::make(
                    route('admin.users.show', ['user' => auth()->user()->slug ]),
                    trans_choice('user.profile.profiles',1),
                    'profile'
                    )
                )
            ->add(
                MenuGroup::make()
                ->setLabel(trans_choice('shelf.shelves', 2))
                ->setIcon('shelves')
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('shelf.shelves', 2))
                    ->add(MenuItem::make(route('admin.shelves.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.shelves.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('collectible.collectibles', 2))
//                    ->add(MenuItem::make(route('collectibles.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.collectibles.create.game'), __('game.add')))
                    ->add(MenuItem::make(route('admin.collectibles.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('collectible.category.categories', 2))
                    ->add(MenuItem::make(route('admin.categories.create'), __('collectible.category.add')))
                    ->add(MenuItem::make(route('admin.categories.index'), __('collectible.category.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('collectible.kit.items', 2))
                    ->add(MenuItem::make(route('admin.kit-items.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.kit-items.index'), __('common.list')))
                )
            )
            ->add(
                MenuGroup::make()
                ->setLabel(trans_choice('game.games', 2))
                ->setIcon('game')
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('game.media.medias', 2))
                    ->add(MenuItem::make(route('admin.game-medias.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.game-medias.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                        ->setLabel(trans_choice('collectible.variation.variations', 2))
                        ->add(MenuItem::make(route('admin.game-media-variations.create'), __('common.add')))
                        ->add(MenuItem::make(route('admin.game-media-variations.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('game.games', 2))
                    ->add(MenuItem::make(route('admin.games.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.games.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('game.developer.developers', 2))
                    ->add(MenuItem::make(route('admin.game-developers.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.game-developers.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('game.publisher.publishers', 2))
                    ->add(MenuItem::make(route('admin.game-publishers.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.game-publishers.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('game.genre.genres', 2))
                    ->add(MenuItem::make(route('admin.game-genres.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.game-genres.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('game.platform.platforms', 2))
                    ->add(MenuItem::make(route('admin.game-platforms.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.game-platforms.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('game.platform_manufacturer.manufacturers', 2))
                    ->add(MenuItem::make(route('admin.game-platform-manufacturers.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.game-platform-manufacturers.index'), __('common.list')))
                )
            )
            ->add(
                MenuGroup::make()
                ->setLabel(trans_choice('user.users', 2))
                ->setIcon('users')
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('user.admins', 2))
                    ->add(MenuItem::make(route('admin.users.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.users.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('user.collectors', 2))
                    ->add(MenuItem::make(route('admin.collectors.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.collectors.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('user.role.roles', 2))
                    ->add(MenuItem::make(route('admin.roles.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.roles.index'), __('common.list')))
                )
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('user.permission.permissions', 2))
                    ->add(MenuItem::make(route('admin.permissions.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.permissions.index'), __('common.list')))
                )
            )
            ->add(
                MenuGroup::make()
                ->setLabel(trans_choice('settings.settings', 2))
                ->setIcon('settings')
                ->add(
                    MenuGroup::make()
                    ->setLabel(trans_choice('settings.country.countries', 2))
                    ->add(MenuItem::make(route('admin.countries.create'), __('common.add')))
                    ->add(MenuItem::make(route('admin.countries.index'), __('common.list')))
                )
            )
            ->add(
                MenuGroup::make()
                    ->setLabel(trans_choice('page.pages', 2))
                    ->setIcon('page')
                    ->add(
                        MenuGroup::make()
                            ->setLabel(trans_choice('page.pages', 2))
                            ->add(MenuItem::make(route('admin.pages.create'), __('common.add')))
                            ->add(MenuItem::make(route('admin.pages.index'), __('common.list')))
                    )
                    ->add(
                        MenuGroup::make()
                            ->setLabel(trans_choice('page.category.categories', 2))
                            ->add(MenuItem::make(route('admin.page-categories.create'), __('common.add')))
                            ->add(MenuItem::make(route('admin.page-categories.index'), __('common.list')))
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
