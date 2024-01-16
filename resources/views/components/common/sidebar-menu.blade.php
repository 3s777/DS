<nav
    {{ $attributes->class([
            'sidebar-menu'
        ])
    }}>
    <x-ui.form.button
        class="content__sidebar-link"
        tag="a"
        color="light">
        Статистика
    </x-ui.form.button>
    <x-ui.form.button
        class="content__sidebar-link"
        tag="a"
        color="light">
        Добавить носитель
    </x-ui.form.button>
    <x-ui.form.button
        class="content__sidebar-link"
        tag="a"
        color="light">
        Добавить игру
    </x-ui.form.button>
    <x-ui.accordion class="sidebar-menu__accordion">
        <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light" open>
            <x-ui.accordion.title class="sidebar-menu__accordion-title">Игры</x-ui.accordion.title>
            <x-ui.accordion.content>
                <x-ui.accordion>
                    <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light" open>
                        <x-ui.accordion.title class="sidebar-menu__accordion-title">Разработчики</x-ui.accordion.title>
                        <x-ui.accordion.content>
                            <x-ui.form.button
                                tag="a"
                                href="{{ route('add-game-developer') }}"
                                color="light"
                                @class(['content__sidebar-link', 'button_submit' => Route::currentRouteName() === 'add-game-developer'])
                            >
                                Добавить
                            </x-ui.form.button>
                            <x-ui.form.button
                                class="content__sidebar-link"
                                tag="a"
                                color="light">
                                Список
                            </x-ui.form.button>
                        </x-ui.accordion.content>
                    </x-ui.accordion.item>

                    <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light">
                        <x-ui.accordion.title class="sidebar-menu__accordion-title">Издатели</x-ui.accordion.title>
                        <x-ui.accordion.content>
                            <x-ui.accordion.content>
                                <x-ui.form.button
                                    class="content__sidebar-link"
                                    tag="a"
                                    color="light">
                                    Добавить
                                </x-ui.form.button>
                                <x-ui.form.button
                                    class="content__sidebar-link"
                                    tag="a"
                                    color="light">
                                    Список
                                </x-ui.form.button>
                            </x-ui.accordion.content>
                        </x-ui.accordion.content>
                    </x-ui.accordion.item>

                    <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light">
                        <x-ui.accordion.title class="sidebar-menu__accordion-title">Жанры</x-ui.accordion.title>
                        <x-ui.accordion.content>
                            <x-ui.accordion.content>
                                <x-ui.form.button
                                    class="content__sidebar-link"
                                    tag="a"
                                    color="light">
                                    Добавить
                                </x-ui.form.button>
                                <x-ui.form.button
                                    class="content__sidebar-link"
                                    tag="a"
                                    color="light">
                                    Список
                                </x-ui.form.button>
                            </x-ui.accordion.content>
                        </x-ui.accordion.content>
                    </x-ui.accordion.item>

                    <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light">
                        <x-ui.accordion.title class="sidebar-menu__accordion-title">Игры</x-ui.accordion.title>
                        <x-ui.accordion.content>
                            <x-ui.accordion.content>
                                <x-ui.form.button
                                    class="content__sidebar-link"
                                    tag="a"
                                    color="light">
                                    Добавить
                                </x-ui.form.button>
                                <x-ui.form.button
                                    class="content__sidebar-link"
                                    tag="a"
                                    color="light">
                                    Список
                                </x-ui.form.button>
                            </x-ui.accordion.content>
                        </x-ui.accordion.content>
                    </x-ui.accordion.item>
                </x-ui.accordion>


            </x-ui.accordion.content>
        </x-ui.accordion.item>
    </x-ui.accordion>

    <x-ui.form.button
        class="content__sidebar-link"
        tag="a"
        color="light">
        Добавить издание
    </x-ui.form.button>
</nav>
