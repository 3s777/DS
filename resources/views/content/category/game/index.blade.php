<x-layouts.main>
    <x-slot:search>
        <x-common.main-search
            :search-placeholder="__('game.media.search')"
            :media-route="route('category.show', ['category' => $category->slug])"
            :variation-route="route('category.variations', ['category' => $category->slug])"
        />
    </x-slot:search>

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

                <x-common.filters.badges class="search__filter-badges" />
            </div>

            <div class="search__result search__result_medias">
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
                                :image-sizes="['large','medium', 'full_preview_300', 'small']"
                                :path="$media->getFeaturedImagePath()"
                                :placeholder="true"
                                sizes="(max-width: 768px) 500px, (max-width: 1400px) 300px, 300px">
                                <x-slot:img alt="{{ $media->name }}" title="{{ $media->name }}"></x-slot:img>
                            </x-ui.responsive-image>
                        </div>
                        <div class="media-card__buttons">
                            <div class="media-card__button">
                                <x-ui.form.button :full-width="true">{{ __('collectible.variation.offer') }}</x-ui.form.button>
                            </div>
                            <div class="media-card__button">
                                <x-ui.form.button :full-width="true">{{ __('common.change_data') }}</x-ui.form.button>
                            </div>
                        </div>

                        <div class="media-card__content">
                            <div class="media-card__content-inner">
                                <x-ui.expand css-height="expanded-media-variations-height" show-text="{{ __('collectible.variation.show_all') }}">
                                    <div class="media-card__variations">
                                    @foreach($media->variations as $variation)
                                        <x-ui.card class="horizontal-variation media-card__variation" size="small" color="dark" :body="false">
                                            @if($variation->is_main)
                                                <div class="horizontal-variation__main">{{ trans_choice('common.main', 1) }}</div>
                                            @endif
                                                <div href="#" class="horizontal-variation__inner">
                                                    <div class="horizontal-variation__featured">
                                                        <a href="{{ route('game.variation.show', $variation->slug) }}">
                                                            <x-ui.responsive-image
                                                                :model="$variation"
                                                                :image-sizes="['extra_small','small']"
                                                                :path="$variation->getFeaturedImagePath()"
                                                                :placeholder="true"
                                                                sizes="(max-width: 768px) 100px, (max-width: 1400px) 100px, 100px">
                                                                <x-slot:img alt="{{ $variation->name }}" title="{{ $variation->name }}"></x-slot:img>
                                                            </x-ui.responsive-image>
                                                        </a>
                                                    </div>
                                                    <div class="horizontal-variation__content">
                                                        <div class="horizontal-variation__title">
                                                            <a href="{{ route('game.variation.show', $variation->slug) }}">
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

                                                <x-ui.form.button href="" class="horizontal-variation__more">{{ __('common.choose') }}</x-ui.form.button>

                                        </x-ui.card>
                                    @endforeach
                                    </div>
                                </x-ui.expand>



                                <div class="media-card__specifications">
                                    <x-ui.expand class="post" css-height="expanded-media-description-height">
                                        {!! $media->description !!}
                                    </x-ui.expand>

                                    <x-ui.specifications>
                                        <x-ui.specifications.item :title="trans_choice('game.platform.platforms', 2)">
                                            @foreach($media->platforms as $platform)
                                                <x-ui.tag color="dark">{{ $platform->name }}</x-ui.tag>
                                            @endforeach
                                        </x-ui.specifications.item>
                                        <x-ui.specifications.item :title="trans_choice('game.genre.genres', 2)">
                                            @foreach($media->genres as $genre)
                                                <x-ui.tag color="dark">{{ $genre->name }}</x-ui.tag>
                                            @endforeach
                                        </x-ui.specifications.item>
                                        @if($media->released_at)
                                            <x-ui.specifications.item :title="__('game.media.released_at')">
                                                <x-ui.tag color="dark">{{ $media->released_at->format('d.m.Y') }}</x-ui.tag>
                                            </x-ui.specifications.item>
                                        @endif
                                        <x-ui.specifications.item :title="trans_choice('game.games', 2)">
                                            @foreach($media->games as $game)
                                                <x-ui.tag color="dark">{{ $game->name }}</x-ui.tag>
                                            @endforeach
                                        </x-ui.specifications.item>
                                        <x-ui.specifications.item :title="trans_choice('game.developer.developers', 2)">
                                            @foreach($media->developers as $developer)
                                                <x-ui.tag color="dark">{{ $developer->name }}</x-ui.tag>
                                            @endforeach
                                        </x-ui.specifications.item>
                                        <x-ui.specifications.item :title="trans_choice('game.publisher.publishers', 2)">
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
            </div>

            <div class="search__pagination">
                {{ $gameMedias->links('pagination::default') }}
            </div>

        </x-common.content>
    </x-grid.container>
</x-layouts.main>
