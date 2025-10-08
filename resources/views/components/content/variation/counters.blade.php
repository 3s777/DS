@props([
    'collection' => false,
    'sale' => false,
    'auction' => false,
    'exchange' => false,
    'favorite' => false,
    'wishlist' => false
])

<div class="content__title-buttons variation__title-buttons">
    @if($collection)
        <x-ui.form.button
            class="variation__title-button"
            tag="a"
            link="/"
            size="small"
            color="dark"
            mobile-icon="true"
            title="{{ __('shelf.on') }}">
            <x-slot:icon>
                <x-svg.check></x-svg.check>
            </x-slot:icon>
            {{ __('shelf.on') }}
            <x-slot:badge>
                <x-ui.badge
                    class="variation__title-badge"
                    type="number"
                    align="standard"
                    color="success">
                    {{ $collection }}
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>
    @endif

    @if($sale)
        <x-ui.form.button
                class="variation__title-button"
                tag="a"
                link="/"
                size="small"
                color="dark"
                mobile-icon="true"
                title="{{ __('common.sale') }}">
                <x-slot:icon>
                    <x-svg.dollar></x-svg.dollar>
                </x-slot:icon>
                {{ __('common.sale') }}
                <x-slot:badge>
                    <x-ui.badge
                        class="variation__title-badge"
                        type="number"
                        align="standard"
                        color="success">
                        {{ $sale }}
                    </x-ui.badge>
                </x-slot:badge>
            </x-ui.form.button>
    @endif

    @if($auction)
        <x-ui.form.button
                class="variation__title-button"
                tag="a"
                link="/"
                size="small"
                color="dark"
                mobile-icon="true"
                title="{{ __('common.auction') }}">
                <x-slot:icon>
                    <x-svg.auction></x-svg.auction>
                </x-slot:icon>
                {{ __('common.auction') }}
                <x-slot:badge>
                    <x-ui.badge
                        class="variation__title-badge"
                        type="number"
                        align="standard"
                        color="success">
                        {{ $auction }}
                    </x-ui.badge>
                </x-slot:badge>
            </x-ui.form.button>
    @endif

    @if($exchange)
        <x-ui.form.button
                class="variation__title-button"
                tag="a"
                link="/"
                size="small"
                color="dark"
                mobile-icon="true"
                title="{{ __('common.exchange') }}">
                <x-slot:icon>
                    <x-svg.exchange></x-svg.exchange>
                </x-slot:icon>
                {{ __('common.exchange') }}
                <x-slot:badge>
                    <x-ui.badge
                        class="variation__title-badge"
                        type="number"
                        align="standard"
                        color="success">
                        {{ $exchange }}
                    </x-ui.badge>
                </x-slot:badge>
            </x-ui.form.button>
    @endif

    @if($favorite)
        <x-ui.form.button
                class="variation__title-button"
                tag="a"
                link="/"
                size="small"
                color="dark"
                mobile-icon="true"
                title="{{ __('common.favorite') }}">
                <x-slot:icon>
                    <x-svg.star></x-svg.star>
                </x-slot:icon>
                {{ __('common.favorite') }}
                <x-slot:badge>
                    <x-ui.badge
                        class="variation__title-badge"
                        type="number"
                        align="standard"
                        color="success">
                        {{ $favorite }}
                    </x-ui.badge>
                </x-slot:badge>
            </x-ui.form.button>
    @endif

    @if($wishlist)
        <x-ui.form.button
            class="variation__title-button"
            tag="a"
            link="/"
            size="small"
            color="dark"
            mobile-icon="true"
            title="{{ __('common.wish') }}">
            <x-slot:icon>
                <x-svg.wishlist></x-svg.wishlist>
            </x-slot:icon>
            {{ __('common.wish') }}
            <x-slot:badge>
                <x-ui.badge
                    class="variation__title-badge"
                    type="number"
                    align="standard"
                    color="success">
                    {{ $wishlist }}
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>
    @endif
</div>
