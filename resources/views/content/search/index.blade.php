@extends('layouts.auth')

@section('title', __('Search'))

@section('content')
    <div class="container">
        <div class="content search">
            <div class="search__title">
                <x-ui.title size="big">
                    Результаты поиска: Naruto Shippuden Ultimate Ninja Storm
                </x-ui.title>
                <div class="search__filters">
                    <div class="search__filters-title">Выбранные фильтры: </div>
                    <x-ui.badge
                        class="search__filter"
                        type="tag"
                        color="dark">
                        Playstation 3
                        <div class="search__filter-delete">
                            <x-svg.close></x-svg.close>
                        </div>
                    </x-ui.badge>
                    <x-ui.badge
                        class="search__filter"
                        type="tag"
                        color="dark">
                        Платформер
                        <div class="search__filter-delete">
                            <x-svg.close></x-svg.close>
                        </div>
                    </x-ui.badge>
                    <x-ui.badge
                        class="search__filter"
                        type="tag"
                        color="dark">
                        Capcom
                        <div class="search__filter-delete">
                            <x-svg.close></x-svg.close>
                        </div>
                    </x-ui.badge>
                    <x-ui.badge
                        class="search__filter"
                        type="tag"
                        color="dark">
                        2010
                        <div class="search__filter-delete">
                            <x-svg.close></x-svg.close>
                        </div>
                    </x-ui.badge>
                </div>
            </div>
            <div class="search__result">
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-300.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="50"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-6.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="17"
                        sale="20"
                        auction="25"
                        exchange="21"
                        favorite="153"
                    />
                </div>
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-7.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    NES
                                </div>
                                <div class="search-card__detail">
                                    1222
                                </div>
                                <div class="search-card__detail">
                                    Std
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    20/06/2024
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="1200"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-8.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto Shippuden Ultimate Ninfa Storm Collection CollectionNaruto Shippuden Ultimate Ninfa Storm Collection Collection
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    Playstation sdfsdfsdfsdfsdfsdf
                                </div>
                                <div class="search-card__detail">
                                    BLES00789xvcxvxcv
                                </div>
                                <div class="search-card__detail">
                                    Essentialsxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcv
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="1200"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-9.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="1200"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-9.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="1200"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-7.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    NES
                                </div>
                                <div class="search-card__detail">
                                    1222
                                </div>
                                <div class="search-card__detail">
                                    Std
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    20/06/2024
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="1200"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-8.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="1200"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-6.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto Shippuden Ultimate Ninfa Storm Collection CollectionNaruto Shippuden Ultimate Ninfa Storm Collection Collection
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    Playstation sdfsdfsdfsdfsdfsdf
                                </div>
                                <div class="search-card__detail">
                                    BLES00789xvcxvxcv
                                </div>
                                <div class="search-card__detail">
                                    Essentialsxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcv
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="1200"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
                <div class="search__item search-card">
                    <div class="search-card__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <img class="search-card__img" src="{{ asset('/storage/test-300.jpg') }}" alt="">
                        </a>
                    </div>

                    <div class="search-card__main">
                        <div class="search-card__info">
                            <div class="search-card__title">
                                <a href="{{ route('game-carrier') }}">
                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection
                                </a>
                            </div>
                            <div class="search-card__details">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                            <div class="search-card__more">
                                <div class="search-card__detail">
                                    Playstation 3
                                </div>
                                <div class="search-card__detail">
                                    BLES00789
                                </div>
                                <div class="search-card__detail">
                                    Essentials
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="search-card__buttons"
                        button_class="search-card__button"
                        badge_class="search-card__badge"
                        add="12"
                        wishlist="1200"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
            </div>
            <div class="search__show-more">
                <x-ui.form.button size="big">{{ __('Показать больше') }}</x-ui.form.button>
            </div>
        </div>
    </div>
@endsection

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
