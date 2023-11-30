<x-layouts.main title="{{ __('Users') }}" :search="false">
    <div class="users__search">
        <x-grid.container>
            <x-ui.input-search
                wrapper-class="users-search__input-search"
                link="{{ route('users') }}"
                placeholder="{{ __('Введите имя пользователя?') }}">
            </x-ui.input-search>
        </x-grid.container>
    </div>

    <x-grid.container>
        <x-common.content class="users">
            <div class="users__title">
                <x-ui.title size="big">
                    Список пользователей
                </x-ui.title>
            </div>

            <div class="users__list">
                <x-ui.card class="users__card" size="small">
                    <a href="" class="user-search__rating" title="Рейтинг пользователя">9.5/10</a>
                    <div class="users__item user-search">
                        <div class="user-search__main">
                            <div class="user-search__thumbnail">
                                <a href=""><img class="user-search__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="user-search__info">
                                <div class="user-search__name"><a href="">Иванов Иван</a></div>
                                <div class="user-search__nickname">
                                    <a href="">@test-usertest-user</a>
                                </div>
                                <div class="user-search__subscribe">
                                    <x-ui.form.button size="small">Подписаться</x-ui.form.button>
                                    <x-ui.form.button class="user-search__button-message" tag="a" href="{{ route('users') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="user-search__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>

                        <x-common.counter-buttons
                            type="light"
                            class="user-search__buttons"
                            button-class="user-search__button"
                            badge-class="user-search__badge"
                            add="12"
                            wishlist="50"
                            sale="5"
                            auction="25"
                            exchange="2"
                        />
                    </div>
                </x-ui.card>

                <x-ui.card class="users__card" size="small">
                    <a href="" class="user-search__rating" title="Рейтинг пользователя">9.5/10</a>
                    <div class="users__item user-search">
                        <div class="user-search__main">
                            <div class="user-search__thumbnail">
                                <a href=""><img class="user-search__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="user-search__info">
                                <div class="user-search__name"><a href="">Иванов Иван</a></div>
                                <div class="user-search__nickname"><a href="">@test-user</a></div>
                                <div class="user-search__subscribe">
                                    <x-ui.form.button color="cancel" size="small">Отписаться</x-ui.form.button>
                                    <x-ui.form.button class="user-search__button-message" tag="a" href="{{ route('users') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="user-search__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>

                        <x-common.counter-buttons
                            type="light"
                            class="user-search__buttons"
                            button-class="user-search__button"
                            badge-class="user-search__badge"
                            add="12"
                            wishlist="50"
                            sale="5"
                            auction="25"
                            exchange="2"
                        />
                    </div>
                </x-ui.card>

                <x-ui.card class="users__card" size="small">
                    <a class="user-search__rating user-search__rating_danger" title="Рейтинг пользователя" >4.5/10</a>
                    <div class="users__item user-search">
                        <div class="user-search__main">
                            <div class="user-search__thumbnail">
                                <a href=""><img class="user-search__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="user-search__info">
                                <div class="user-search__name"><a href="">Тестов Тест Тестович</a> </div>
                                <div class="user-search__nickname"><a href="">@testovichhhh</a></div>
                                <div class="user-search__subscribe">
                                    <x-ui.form.button size="small">Подписаться</x-ui.form.button>
                                    <x-ui.form.button class="user-search__button-message" tag="a" href="{{ route('users') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="user-search__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>

                        <x-common.counter-buttons
                            type="light"
                            class="user-search__buttons"
                            button-class="user-search__button"
                            badge-class="user-search__badge"
                            add="1200"
                            wishlist="5000"
                            sale="500000"
                            auction="2500"
                            exchange="2"
                        />
                    </div>
                </x-ui.card>

                <x-ui.card class="users__card" size="small">
                    <a class="user-search__rating user-search__rating_warning" title="Рейтинг пользователя" >6/10</a>
                    <div class="users__item user-search">
                        <div class="user-search__main">
                            <div class="user-search__thumbnail">
                                <a href=""><img class="user-search__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="user-search__info">
                                <div class="user-search__name"><a href="">Фатхурдинов Александр</a></div>
                                <div class="user-search__nickname"><a href="">@test-user</a></div>
                                <div class="user-search__subscribe">
                                    <x-ui.form.button size="small">Подписаться</x-ui.form.button>
                                    <x-ui.form.button class="user-search__button-message" tag="a" href="{{ route('users') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="user-search__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>

                        <x-common.counter-buttons
                            type="light"
                            class="user-search__buttons"
                            button-class="user-search__button"
                            badge-class="user-search__badge"
                            add="12"
                            wishlist="50"
                            sale="5"
                            auction="25"
                            exchange="2"
                        />
                    </div>
                </x-ui.card>

                <x-ui.card class="users__card" size="small">
                    <div class="users__item user-search">
                        <div class="user-search__main">
                            <div class="user-search__thumbnail">
                                <a href=""><img class="user-search__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="user-search__info">
                                <div class="user-search__name"><a href="">Иванов Иван</a></div>
                                <div class="user-search__nickname"><a href="">@test-user</a> <x-ui.tag class="user-search__rating" title="Рейтинг пользователя" color="success">9.5/10</x-ui.tag></div>
                                <div class="user-search__subscribe">
                                    <x-ui.form.button color="cancel" size="small">Отписаться</x-ui.form.button>
                                    <x-ui.form.button class="user-search__button-message" tag="a" href="{{ route('users') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="user-search__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>

                        <x-common.counter-buttons
                            type="light"
                            class="user-search__buttons"
                            button-class="user-search__button"
                            badge-class="user-search__badge"
                            add="12"
                            wishlist="50"
                            sale="5"
                            auction="25"
                            exchange="2"
                        />
                    </div>
                </x-ui.card>

                <x-ui.card class="users__card" size="small">
                    <div class="users__item user-search">
                        <div class="user-search__main">
                            <div class="user-search__thumbnail">
                                <a href=""><img class="user-search__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="user-search__info">
                                <div class="user-search__name"><a href="">Тестов Тест Тестович</a></div>
                                <div class="user-search__nickname"><a href="">@testovichhhh</a> <x-ui.tag class="user-search__rating" title="Рейтинг пользователя" color="success">9.5/10</x-ui.tag></div>
                                <div class="user-search__subscribe">
                                    <x-ui.form.button size="small">Подписаться</x-ui.form.button>
                                    <x-ui.form.button class="user-search__button-message" tag="a" href="{{ route('users') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="user-search__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>

                        <x-common.counter-buttons
                            type="light"
                            class="user-search__buttons"
                            button-class="user-search__button"
                            badge-class="user-search__badge"
                            add="1200"
                            wishlist="5000"
                            sale="500000"
                            auction="2500"
                            exchange="2"
                        />
                    </div>
                </x-ui.card>

                <x-ui.card class="users__card" size="small">
                    <div class="users__item user-search">
                        <div class="user-search__main">
                            <div class="user-search__thumbnail">
                                <a href=""><img class="user-search__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="user-search__info">
                                <div class="user-search__name"><a href="">Иванов Иван</a></div>
                                <div class="user-search__nickname"><a href="">@test-user</a> <x-ui.tag class="user-search__rating" title="Рейтинг пользователя" color="success">9.5/10</x-ui.tag></div>
                                <div class="user-search__subscribe">
                                    <x-ui.form.button size="small">Подписаться</x-ui.form.button>
                                    <x-ui.form.button class="user-search__button-message" tag="a" href="{{ route('users') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="user-search__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>

                        <x-common.counter-buttons
                            type="light"
                            class="user-search__buttons"
                            button-class="user-search__button"
                            badge-class="user-search__badge"
                            add="12"
                            wishlist="50"
                            sale="5"
                            auction="25"
                            exchange="2"
                        />
                    </div>
                </x-ui.card>

                <x-ui.card class="users__card" size="small">
                    <div class="users__item user-search">
                        <div class="user-search__main">
                            <div class="user-search__thumbnail">
                                <a href=""><img class="user-search__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="user-search__info">
                                <div class="user-search__name"><a href="">Иванов Иван</a></div>
                                <div class="user-search__nickname"><a href="">@test-user</a> <x-ui.tag class="user-search__rating" title="Рейтинг пользователя" color="success">9.5/10</x-ui.tag></div>
                                <div class="user-search__subscribe">
                                    <x-ui.form.button size="small">Подписаться</x-ui.form.button>
                                    <x-ui.form.button class="user-search__button-message" tag="a" href="{{ route('users') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="user-search__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>

                        <x-common.counter-buttons
                            type="light"
                            class="user-search__buttons"
                            button-class="user-search__button"
                            badge-class="user-search__badge"
                            add="12"
                            wishlist="50"
                            sale="5"
                            auction="25"
                            exchange="2"
                        />
                    </div>
                </x-ui.card>
            </div>
        </x-common.content>
    </x-grid.container>

    @push('scripts')
        <script type="module">
            var selects = document.getElementsByClassName("choices-select-auto");
            for (var i = 0; i < selects.length; i++) {
                new Choices(selects.item(i), {
                    itemSelectText: '',
                    searchEnabled: false,
                    shouldSort: false,
                    allowHTML: true,
                    noResultsText: '{{ __('Не найдено') }}',
                    noChoicesText: '{{ __('Больше ничего нет') }}',
                });
            }
        </script>
    @endpush
</x-layouts.main>
