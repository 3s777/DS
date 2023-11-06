<x-layouts.main title="{{ __('Users') }}" :search="false">
    <div class="users__search">
        <x-grid.container>
            <x-ui.input-search
                wrapper_class="users-search__input-search"
                link="{{ route('users') }}"
                placeholder="{{ __('Введите имя пользователя?') }}">
            </x-ui.input-search>
        </x-grid.container>
    </div>

    <x-grid.container>
        <div class="content users">
            <div class="users__title">
                <x-ui.title size="big">
                    Список пользователей
                </x-ui.title>
            </div>

            <div class="users__list">
                <x-ui.card size="small">
                    <div class="users__item user-search">
                        <div class="user-search__main">
                            <div class="user-search__thumbnail">
                                <img class="user-search__img" src="{{ asset('/storage/test-300.jpg') }}" alt="">
                            </div>
                            <div class="user-search__info">
                                <div class="user-search__name">Иванов Иван</div>
                                <div class="user-search__nickname">@test-user</div>
                                <div class="user-search__main-buttons">
                                    <x-ui.form.button size="small">Подписаться</x-ui.form.button>
                                    <x-ui.form.button size="small">Сообщение</x-ui.form.button>
                                    <x-ui.form.button size="small">Перейти в блог</x-ui.form.button>
                                </div>
                            </div>
                        </div>
                        <x-common.counter-buttons
                            class="users-search__buttons"
                            button_class="users-search__button"
                            badge_class="users-search__badge"
                            add="12"
                            wishlist="50"
                            sale="5"
                            auction="25"
                            exchange="2"
                        />
                    </div>
                </x-ui.card>
            </div>
        </div>
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
