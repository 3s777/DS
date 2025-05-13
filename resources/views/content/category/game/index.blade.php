<x-layouts.main title="Search" filters="content.category.game.filters" :search-placeholder="__('game.media.search')">

    <x-slot:mainFilters>
        @include('content.category.game.filters')
    </x-slot:mainFilters>

    <x-grid.container>
        <x-common.content class="search">

            <x-common.messages />

            <div class="search__title">
                <x-ui.title size="big">
                    @if(request('filters.search'))
                        {{ __('filters.result') }} "{{ request('filters.search') }}"
                    @else
                        {{ __('game.media.list') }}
                    @endif
                </x-ui.title>

                <x-common.filters.badges class="search__filters" />
            </div>

            @foreach($gameMedias as $media)
                <x-ui.card class="media-card" body="false">

                    <x-slot:header>
                        <x-ui.title indent="big">{{ $media->name }}</x-ui.title>
                    </x-slot:header>

                    <div class="media-card__body">
                        <div class="media-card__featured">
                            <x-ui.responsive-image
                                class="media-card__featured-img"
                                :model="$media"
                                :image-sizes="['large','medium', 'small']"
                                :path="$media->getFeaturedImagePath()"
                                :placeholder="true"
                                :wrapper="true"
                                wrapper-class="media-card__featured-inner"
                                sizes="(max-width: 768px) 300px, (max-width: 1400px) 300px, 300px">
                                <x-slot:img alt="{{ $media->name }}" title="{{ $media->name }}"></x-slot:img>
                            </x-ui.responsive-image>
                        </div>
                        <div class="media-card__buttons">
                            <div class="media-card__button">
                                <x-ui.form.button :full-width="true">Предложить вариацию</x-ui.form.button>
                            </div>
                            <div class="media-card__button">
                                <x-ui.form.button :full-width="true">Изменить данные</x-ui.form.button>
                            </div>
                        </div>

                        <div class="media-card__content">
                            <div class="media-card__content-inner">


                                    <x-ui.expand css-height="expanded-media-variations-height" show-text="Показать все вариации">
                                        <div class="media-card__variations">
                                        @foreach($media->variations as $variation)
                                            <x-ui.card class="horizontal-variation media-card__variation" size="small" color="dark" :body="false">
                                                @if($variation->is_main)
                                                    <div class="horizontal-variation__main">главная</div>
                                                @endif
                                                    <div href="#" class="horizontal-variation__inner">
                                                        <div class="horizontal-variation__featured">
                                                            <x-ui.responsive-image
                                                                :model="$variation"
                                                                :image-sizes="['extra_small','small']"
                                                                :path="$variation->getFeaturedImagePath()"
                                                                :placeholder="true"
                                                                :wrapper="true"
                                                                wrapper-class="horizontal-variation__featured-inner"
                                                                sizes="(max-width: 768px) 100px, (max-width: 1400px) 100px, 100px">
                                                                <x-slot:img alt="{{ $variation->name }}" title="{{ $variation->name }}"></x-slot:img>
                                                            </x-ui.responsive-image>
                                                        </div>
                                                        <div class="horizontal-variation__content">
                                                            <div class="horizontal-variation__title">
                                                                <a href="{{ route('admin.game-media-variations.edit', $variation->slug) }}">
                                                                    {{ $variation->name }}
                                                                </a>
                                                            </div>
                                                            <div class="horizontal-variation__specifications">
                                                                <x-ui.tag>{{ $variation->article_number }}</x-ui.tag>
                                                                @foreach($variation->barcodes as $barcode)
                                                                    @if($barcode)
                                                                        <x-ui.tag>{{ $barcode }}</x-ui.tag>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <x-ui.form.button href="" class="horizontal-variation__more">Выбрать</x-ui.form.button>

                                            </x-ui.card>
                                        @endforeach
                                        </div>
                                    </x-ui.expand>



                                <div class="media-card__specifications">
                                    <x-ui.expand class="post" css-height="expanded-media-description-height">
                                        {!! $media->description !!}
                                    </x-ui.expand>


                                    <x-ui.specifications>
                                        <x-ui.specifications.item title="Платформы">
                                            @foreach($media->platforms as $platform)
                                                <x-ui.tag color="dark">{{ $platform->name }}</x-ui.tag>
                                            @endforeach
                                        </x-ui.specifications.item>
                                        <x-ui.specifications.item title="Жанры">
                                            @foreach($media->genres as $genre)
                                                <x-ui.tag color="dark">{{ $genre->name }}</x-ui.tag>
                                            @endforeach
                                        </x-ui.specifications.item>
                                        @if($media->released_at)
                                            <x-ui.specifications.item title="Дата релиза">
                                                <x-ui.tag color="dark">{{ $media->released_at->format('d.m.Y') }}</x-ui.tag>
                                            </x-ui.specifications.item>
                                        @endif
                                        <x-ui.specifications.item title="Игры">
                                            @foreach($media->games as $game)
                                                <x-ui.tag color="dark">{{ $game->name }}</x-ui.tag>
                                            @endforeach
                                        </x-ui.specifications.item>
                                        <x-ui.specifications.item title="Разработчики">
                                            @foreach($media->developers as $developer)
                                                <x-ui.tag color="dark">{{ $developer->name }}</x-ui.tag>
                                            @endforeach
                                        </x-ui.specifications.item>
                                        <x-ui.specifications.item title="Издатели">
                                            @foreach($media->publishers as $publisher)
                                                <x-ui.tag color="dark">{{ $publisher->name }}</x-ui.tag>
                                            @endforeach
                                        </x-ui.specifications.item>
                                    </x-ui.specifications>
                                </div>
                            </div>
                        </div>
                    </div>





                </x-ui.card>
            @endforeach

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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
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
                        button-class="search-card__button"
                        badge-class="search-card__badge"
                        type="light"
                        add="12"
                        wishlist="1200"
                        sale="5"
                        auction="25"
                        exchange="2"
                        favorite="153"
                    />
                </div>
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
