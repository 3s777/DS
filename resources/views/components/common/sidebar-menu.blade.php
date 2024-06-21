@foreach($menu->all() as $item)
    <a href="{{ $item->link() }}" class="link @if($item->isActive()) active @endif">{{ $item->label() }}</a>
@endforeach

<nav
    :class="collapseSidebar ?  'sidebar-menu_collapsed' : ''"
    {{ $attributes->class([
            'sidebar-menu'
        ])
    }}>
    <x-ui.form.button
        x-on:click="collapseSidebar = ! collapseSidebar"
        class="content__sidebar-link sidebar-menu__link sidebar-menu__link_collapse"
        tag="a"
        color="light"
        title="Развернуть меню">
        <x-slot:icon class="sidebar-menu__link-icon sidebar-menu__link-icon_collapse">
            <x-svg.collapse-left />
        </x-slot:icon>
        <span class="sidebar-menu__link-label">Свернуть меню</span>
    </x-ui.form.button>

    <div class="sidebar-menu__content">
        <x-ui.form.button
            class="content__sidebar-link sidebar-menu__link"
            tag="a"
            color="light">
            <x-slot:icon class="sidebar-menu__link-icon">
                <x-svg.statistic />
            </x-slot:icon>
            <span class="sidebar-menu__link-label">Статистика</span>
        </x-ui.form.button>

        <x-ui.form.button
            class="content__sidebar-link sidebar-menu__link"
            tag="a"
            color="light">
            <x-slot:icon class="sidebar-menu__link-icon">
                <x-svg.profile />
            </x-slot:icon>
            <span class="sidebar-menu__link-label">Профиль</span>
        </x-ui.form.button>

        <div class="sidebar-menu__accordion-wrapper">
            <x-ui.form.button
                class="sidebar-menu__link sidebar-menu__link-icon_toggle"
                tag="a"
                color="light">
                <x-slot:icon class="sidebar-menu__link-icon">
                    <x-svg.game />
                </x-slot:icon>
            </x-ui.form.button>

            <x-ui.accordion class="sidebar-menu__accordion">
                <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light" open>
                    <x-ui.accordion.title class="sidebar-menu__accordion-title">
                        <span class="sidebar-menu__link-label">Игры</span>
                    </x-ui.accordion.title>
                    <x-ui.accordion.content>
                        <x-ui.accordion>
                            <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light" open>
                                <x-ui.accordion.title class="sidebar-menu__accordion-title">
                                    <span class="sidebar-menu__link-label">Разработчики</span>
                                </x-ui.accordion.title>
                                <x-ui.accordion.content>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'game-developers.create'])
                                        tag="a"
                                        link="{{ route('game-developers.create') }}"
                                        color="light"
                                    >
                                        <span class="sidebar-menu__link-label">Добавить</span>
                                    </x-ui.form.button>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'game-developers.index'])
                                        tag="a"
                                        link="{{ route('game-developers.index') }}"
                                        color="light">
                                        <span class="sidebar-menu__link-label">Список</span>
                                    </x-ui.form.button>
                                </x-ui.accordion.content>
                            </x-ui.accordion.item>

                            <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light">
                                <x-ui.accordion.title class="sidebar-menu__accordion-title">
                                    <span class="sidebar-menu__link-label">Издатели</span>
                                </x-ui.accordion.title>
                                <x-ui.accordion.content>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'game-developers.create'])
                                        tag="a"
                                        link="{{ route('game-developers.create') }}"
                                        color="light"
                                    >
                                        <span class="sidebar-menu__link-label">Добавить</span>
                                    </x-ui.form.button>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'game-developers.index'])
                                        tag="a"
                                        link="{{ route('game-developers.index') }}"
                                        color="light">
                                        <span class="sidebar-menu__link-label">Список</span>
                                    </x-ui.form.button>
                                </x-ui.accordion.content>
                            </x-ui.accordion.item>

                        </x-ui.accordion>

                    </x-ui.accordion.content>
                </x-ui.accordion.item>
            </x-ui.accordion>

            <x-ui.accordion class="sidebar-menu__accordion">
                <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light" open>
                    <x-ui.accordion.title class="sidebar-menu__accordion-title">
                        <span class="sidebar-menu__link-label">Пользователи</span>
                    </x-ui.accordion.title>
                    <x-ui.accordion.content>


                            <x-ui.form.button
                                @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'users.index'])
                                tag="a"
                                link="{{ route('users.index') }}"
                                color="light">
                                <span class="sidebar-menu__link-label">Список</span>
                            </x-ui.form.button>

                            <x-ui.form.button
                                @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'users.create'])
                                tag="a"
                                link="{{ route('users.create') }}"
                                color="light"
                            >
                                <span class="sidebar-menu__link-label">Добавить</span>
                            </x-ui.form.button>

                        <x-ui.accordion>
                            <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light">
                                <x-ui.accordion.title class="sidebar-menu__accordion-title">
                                    <span class="sidebar-menu__link-label">Роли</span>
                                </x-ui.accordion.title>
                                <x-ui.accordion.content>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'roles.create'])
                                        tag="a"
                                        link="{{ route('roles.create') }}"
                                        color="light"
                                    >
                                        <span class="sidebar-menu__link-label">Добавить</span>
                                    </x-ui.form.button>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'roles.index'])
                                        tag="a"
                                        link="{{ route('roles.index') }}"
                                        color="light">
                                        <span class="sidebar-menu__link-label">Список</span>
                                    </x-ui.form.button>
                                </x-ui.accordion.content>
                            </x-ui.accordion.item>

                        </x-ui.accordion>

                        <x-ui.accordion>
                            <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light">
                                <x-ui.accordion.title class="sidebar-menu__accordion-title">
                                    <span class="sidebar-menu__link-label">Разрешения</span>
                                </x-ui.accordion.title>
                                <x-ui.accordion.content>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'permissions.create'])
                                        tag="a"
                                        link="{{ route('permissions.create') }}"
                                        color="light"
                                    >
                                        <span class="sidebar-menu__link-label">Добавить</span>
                                    </x-ui.form.button>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'permissions.index'])
                                        tag="a"
                                        link="{{ route('permissions.index') }}"
                                        color="light">
                                        <span class="sidebar-menu__link-label">Список</span>
                                    </x-ui.form.button>
                                </x-ui.accordion.content>
                            </x-ui.accordion.item>

                        </x-ui.accordion>

                    </x-ui.accordion.content>
                </x-ui.accordion.item>
            </x-ui.accordion>
        </div>

    </div>
</nav>

<script>
    const list = document.querySelectorAll('.sidebar-menu__link-icon_toggle')

    const sidebar = document.querySelector('.content__sidebar')

    const menu = document.querySelector('.sidebar-menu')

    list.forEach(item =>{
        item.addEventListener('click', (e) =>{
            sidebar.classList.remove('content__sidebar_collapsed');
            menu.classList.remove('sidebar-menu_collapsed');
            // list.forEach(el=>{ el.classList.remove('active'); });
            // item.classList.add('active')
        })
    })
</script>
