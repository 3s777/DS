<x-layouts.main>
    <x-slot:search>
        <x-common.main-search
            :search-placeholder="__('game.media.search')"
            :media-route="route('category.show', ['category' => $category->slug])"
            :variation-route="route('category.variations', ['category' => $category->slug])"
        />
    </x-slot:search>

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
                        <a href="{{ route('game.variation.show', $variation->slug) }}">
                            <div class="vertical-variation__thumbnail-inner">
                                <x-ui.responsive-image
                                    :model="$variation"
                                    :image-sizes="['extra_small','small', 'medium']"
                                    :path="$variation->getFeaturedImagePath()"
                                    :placeholder="true"
                                    sizes="(max-width: 768px) 260px, (max-width: 1400px) 260px, 260px">
                                    <x-slot:img alt="{{ $variation->name }}" title="{{ $variation->name }}"></x-slot:img>
                                </x-ui.responsive-image>
                            </div>
                        </a>
                    </div>

                    <div class="vertical-variation__main">
                        <div class="vertical-variation__info">
                            <div class="vertical-variation__title">
                                <a href="{{ route('game.variation.show', $variation->slug) }}">
                                    {{ $variation->name }}
                                </a>
                            </div>
                            <div class="vertical-variation__details">
                                <x-ui.tag color="dark" class="vertical-variation__detail">{{ $variation->article_number }}</x-ui.tag>
                            </div>
                            <div class="vertical-variation__more">
                                @foreach($variation->barcodes as $barcode)
                                    @if($barcode)
                                        <x-ui.tag color="dark" class="vertical-variation__detail">{{ $barcode }}</x-ui.tag>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <x-common.counter-buttons
                        class="vertical-variation__buttons"
                        button-class="vertical-variation__button"
                        badge-class="vertical-variation__badge"
                        type="light"
                        :collection="$variation->collection_count"
                        wishlist="50"
                        :sale="$variation->sale_count"
                        :auction="$variation->auction_count"
                        :exchange="$variation->exchange_count"
                        favorite="153"
                    />
                </div>
                @endforeach
            </div>

            <div class="search__pagination">
                {{ $variations->links('pagination::default') }}
            </div>

        </x-common.content>
    </x-grid.container>
</x-layouts.main>
