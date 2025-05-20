<x-layouts.main title="Search" filters="content.category.game.filters" :search-placeholder="__('game.media.search')">

    <x-slot:mainFilters>
        @include('content.category.game.filters-variation')
    </x-slot:mainFilters>

    <x-grid.container>
        <x-common.content class="search">

            <x-common.messages />

            <div class="search__title">
                <x-ui.title size="big">
                    @if(request('filters.search'))
                        {{ __('filters.result') }} "{{ request('filters.search') }}"
                    @else
                        {{ __('game.variation.list') }}
                    @endif
                </x-ui.title>

                <x-common.filters.badges class="search__filter-badges" />
            </div>

            <div class="search__result search__result_variations">

                @foreach($variations as $variation)
                <div class="search__item vertical-variation">
                    <div class="vertical-variation__thumbnail">
                        <a href="{{ route('game-carrier') }}">
                            <x-ui.responsive-image
                                :model="$variation"
                                :image-sizes="['extra_small','small', 'medium']"
                                :path="$variation->getFeaturedImagePath()"
                                :placeholder="true"
                                :wrapper="true"
                                wrapper-class="vertical-variation__thumbnail-inner"
                                sizes="(max-width: 768px) 260px, (max-width: 1400px) 260px, 260px">
                                <x-slot:img alt="{{ $variation->name }}" title="{{ $variation->name }}"></x-slot:img>
                            </x-ui.responsive-image>
                        </a>
                    </div>

                    <div class="vertical-variation__main">
                        <div class="vertical-variation__info">
                            <div class="vertical-variation__title">
                                <a href="{{ route('game-carrier') }}">
                                    {{ $variation->name }}
                                </a>
                            </div>
                            <div class="vertical-variation__details">
                                <div class="vertical-variation__detail">
                                    Playstation 3
                                </div>
                                <div class="vertical-variation__detail">
                                    BLES00789
                                </div>
                                <div class="vertical-variation__detail">
                                    Essentials
                                </div>
                            </div>
                            <div class="vertical-variation__more">
                                <div class="vertical-variation__detail">
                                    Playstation 3
                                </div>
                                <div class="vertical-variation__detail">
                                    BLES00789
                                </div>
                                <div class="vertical-variation__detail">
                                    Essentials
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="vertical-variation__buttons"
                        button-class="vertical-variation__button"
                        badge-class="vertical-variation__badge"
                        type="light"
                        add="12"
                        wishlist="50"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
                @endforeach




{{--                <div class="search__item vertical-variation">--}}
{{--                    <div class="vertical-variation__thumbnail">--}}
{{--                        <a href="{{ route('game-carrier') }}">--}}
{{--                            <img class="vertical-variation__img" src="{{ asset('/storage/test-6.jpg') }}" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="vertical-variation__main">--}}
{{--                        <div class="vertical-variation__info">--}}
{{--                            <div class="vertical-variation__title">--}}
{{--                                <a href="{{ route('game-carrier') }}">--}}
{{--                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__details">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__more">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <x-common.counter-buttons--}}
{{--                        class="vertical-variation__buttons"--}}
{{--                        button-class="vertical-variation__button"--}}
{{--                        badge-class="vertical-variation__badge"--}}
{{--                        type="light"--}}
{{--                        add="12"--}}
{{--                        wishlist="17"--}}
{{--                        sale="20"--}}
{{--                        auction="25"--}}
{{--                        exchange="21"--}}
{{--                        favorite="153"--}}
{{--                    />--}}
{{--                </div>--}}
{{--                <div class="search__item vertical-variation">--}}
{{--                    <div class="vertical-variation__thumbnail">--}}
{{--                        <a href="{{ route('game-carrier') }}">--}}
{{--                            <img class="vertical-variation__img" src="{{ asset('/storage/test-7.jpg') }}" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="vertical-variation__main">--}}
{{--                        <div class="vertical-variation__info">--}}
{{--                            <div class="vertical-variation__title">--}}
{{--                                <a href="{{ route('game-carrier') }}">--}}
{{--                                    Naruto--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__details">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    NES--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    1222--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Std--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__more">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    20/06/2024--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <x-common.counter-buttons--}}
{{--                        class="vertical-variation__buttons"--}}
{{--                        button-class="vertical-variation__button"--}}
{{--                        badge-class="vertical-variation__badge"--}}
{{--                        type="light"--}}
{{--                        add="12"--}}
{{--                        wishlist="1200"--}}
{{--                        sale="5"--}}
{{--                        auction="25"--}}
{{--                        exchange="2"--}}
{{--                        favorite="153"--}}
{{--                    />--}}
{{--                </div>--}}
{{--                <div class="search__item vertical-variation">--}}
{{--                    <div class="vertical-variation__thumbnail">--}}
{{--                        <a href="{{ route('game-carrier') }}">--}}
{{--                            <img class="vertical-variation__img" src="{{ asset('/storage/test-8.jpg') }}" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="vertical-variation__main">--}}
{{--                        <div class="vertical-variation__info">--}}
{{--                            <div class="vertical-variation__title">--}}
{{--                                <a href="{{ route('game-carrier') }}">--}}
{{--                                    Naruto Shippuden Ultimate Ninfa Storm Collection CollectionNaruto Shippuden Ultimate Ninfa Storm Collection Collection--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__details">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation sdfsdfsdfsdfsdfsdf--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789xvcxvxcv--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentialsxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcv--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__more">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <x-common.counter-buttons--}}
{{--                        class="vertical-variation__buttons"--}}
{{--                        button-class="vertical-variation__button"--}}
{{--                        badge-class="vertical-variation__badge"--}}
{{--                        type="light"--}}
{{--                        add="12"--}}
{{--                        wishlist="1200"--}}
{{--                        sale="5"--}}
{{--                        auction="25"--}}
{{--                        exchange="2"--}}
{{--                        favorite="153"--}}
{{--                    />--}}
{{--                </div>--}}
{{--                <div class="search__item vertical-variation">--}}
{{--                    <div class="vertical-variation__thumbnail">--}}
{{--                        <a href="{{ route('game-carrier') }}">--}}
{{--                            <img class="vertical-variation__img" src="{{ asset('/storage/test-9.jpg') }}" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="vertical-variation__main">--}}
{{--                        <div class="vertical-variation__info">--}}
{{--                            <div class="vertical-variation__title">--}}
{{--                                <a href="{{ route('game-carrier') }}">--}}
{{--                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__details">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__more">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <x-common.counter-buttons--}}
{{--                        class="vertical-variation__buttons"--}}
{{--                        button-class="vertical-variation__button"--}}
{{--                        badge-class="vertical-variation__badge"--}}
{{--                        type="light"--}}
{{--                        add="12"--}}
{{--                        wishlist="1200"--}}
{{--                        sale="5"--}}
{{--                        auction="25"--}}
{{--                        exchange="2"--}}
{{--                        favorite="153"--}}
{{--                    />--}}
{{--                </div>--}}
{{--                <div class="search__item vertical-variation">--}}
{{--                    <div class="vertical-variation__thumbnail">--}}
{{--                        <a href="{{ route('game-carrier') }}">--}}
{{--                            <img class="vertical-variation__img" src="{{ asset('/storage/test-9.jpg') }}" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="vertical-variation__main">--}}
{{--                        <div class="vertical-variation__info">--}}
{{--                            <div class="vertical-variation__title">--}}
{{--                                <a href="{{ route('game-carrier') }}">--}}
{{--                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__details">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__more">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <x-common.counter-buttons--}}
{{--                        class="vertical-variation__buttons"--}}
{{--                        button-class="vertical-variation__button"--}}
{{--                        badge-class="vertical-variation__badge"--}}
{{--                        type="light"--}}
{{--                        add="12"--}}
{{--                        wishlist="1200"--}}
{{--                        sale="5"--}}
{{--                        auction="25"--}}
{{--                        exchange="2"--}}
{{--                        favorite="153"--}}
{{--                    />--}}
{{--                </div>--}}
{{--                <div class="search__item vertical-variation">--}}
{{--                    <div class="vertical-variation__thumbnail">--}}
{{--                        <a href="{{ route('game-carrier') }}">--}}
{{--                            <img class="vertical-variation__img" src="{{ asset('/storage/test-7.jpg') }}" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="vertical-variation__main">--}}
{{--                        <div class="vertical-variation__info">--}}
{{--                            <div class="vertical-variation__title">--}}
{{--                                <a href="{{ route('game-carrier') }}">--}}
{{--                                    Naruto--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__details">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    NES--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    1222--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Std--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__more">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    20/06/2024--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <x-common.counter-buttons--}}
{{--                        class="vertical-variation__buttons"--}}
{{--                        button-class="vertical-variation__button"--}}
{{--                        badge-class="vertical-variation__badge"--}}
{{--                        type="light"--}}
{{--                        add="12"--}}
{{--                        wishlist="1200"--}}
{{--                        sale="5"--}}
{{--                        auction="25"--}}
{{--                        exchange="2"--}}
{{--                        favorite="153"--}}
{{--                    />--}}
{{--                </div>--}}
{{--                <div class="search__item vertical-variation">--}}
{{--                    <div class="vertical-variation__thumbnail">--}}
{{--                        <a href="{{ route('game-carrier') }}">--}}
{{--                            <img class="vertical-variation__img" src="{{ asset('/storage/test-8.jpg') }}" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="vertical-variation__main">--}}
{{--                        <div class="vertical-variation__info">--}}
{{--                            <div class="vertical-variation__title">--}}
{{--                                <a href="{{ route('game-carrier') }}">--}}
{{--                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__details">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__more">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <x-common.counter-buttons--}}
{{--                        class="vertical-variation__buttons"--}}
{{--                        button-class="vertical-variation__button"--}}
{{--                        badge-class="vertical-variation__badge"--}}
{{--                        type="light"--}}
{{--                        add="12"--}}
{{--                        wishlist="1200"--}}
{{--                        sale="5"--}}
{{--                        auction="25"--}}
{{--                        exchange="2"--}}
{{--                        favorite="153"--}}
{{--                    />--}}
{{--                </div>--}}
{{--                <div class="search__item vertical-variation">--}}
{{--                    <div class="vertical-variation__thumbnail">--}}
{{--                        <a href="{{ route('game-carrier') }}">--}}
{{--                            <img class="vertical-variation__img" src="{{ asset('/storage/test-6.jpg') }}" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="vertical-variation__main">--}}
{{--                        <div class="vertical-variation__info">--}}
{{--                            <div class="vertical-variation__title">--}}
{{--                                <a href="{{ route('game-carrier') }}">--}}
{{--                                    Naruto Shippuden Ultimate Ninfa Storm Collection CollectionNaruto Shippuden Ultimate Ninfa Storm Collection Collection--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__details">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation sdfsdfsdfsdfsdfsdf--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789xvcxvxcv--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentialsxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcvxcv--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__more">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <x-common.counter-buttons--}}
{{--                        class="vertical-variation__buttons"--}}
{{--                        button-class="vertical-variation__button"--}}
{{--                        badge-class="vertical-variation__badge"--}}
{{--                        type="light"--}}
{{--                        add="12"--}}
{{--                        wishlist="1200"--}}
{{--                        sale="5"--}}
{{--                        auction="25"--}}
{{--                        exchange="2"--}}
{{--                        favorite="153"--}}
{{--                    />--}}
{{--                </div>--}}
{{--                <div class="search__item vertical-variation">--}}
{{--                    <div class="vertical-variation__thumbnail">--}}
{{--                        <a href="{{ route('game-carrier') }}">--}}
{{--                            <img class="vertical-variation__img" src="{{ asset('/storage/test-300.jpg') }}" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="vertical-variation__main">--}}
{{--                        <div class="vertical-variation__info">--}}
{{--                            <div class="vertical-variation__title">--}}
{{--                                <a href="{{ route('game-carrier') }}">--}}
{{--                                    Naruto Shippuden Ultimate Ninfa Storm Collection Collection--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__details">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="vertical-variation__more">--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Playstation 3--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    BLES00789--}}
{{--                                </div>--}}
{{--                                <div class="vertical-variation__detail">--}}
{{--                                    Essentials--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <x-common.counter-buttons--}}
{{--                        class="vertical-variation__buttons"--}}
{{--                        button-class="vertical-variation__button"--}}
{{--                        badge-class="vertical-variation__badge"--}}
{{--                        type="light"--}}
{{--                        add="12"--}}
{{--                        wishlist="1200"--}}
{{--                        sale="5"--}}
{{--                        auction="25"--}}
{{--                        exchange="2"--}}
{{--                        favorite="153"--}}
{{--                    />--}}
{{--                </div>--}}
            </div>

            <div class="search__pagination">
                {{ $variations->links('pagination::default') }}
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
