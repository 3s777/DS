<div
    {{ $attributes->class([
            'counter-buttons',
            'counter-buttons_'.$type => $type,
        ])
    }}>

    @if($subscribers)
        <x-ui.form.button
            class="counter-buttons__badge {{ $buttonClass }}"
            tag="div"
            only-icon="true"
            size="small"
            color="dark"
            title="{{ __('common.subscribers') }}">
            <x-slot:icon>
                <x-svg.users></x-svg.users>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge counter-buttons__badge-collector-count {{ $badgeClass }}"
                    type="number"
                    align="standard"
                    data-subscribers="{{ $subscribers }}"
                    color="success">
                    {{ $subscribers }}
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>
    @endif

    @if($collection)
        <x-ui.form.button
            class="counter-buttons__badge {{ $buttonClass }}"
            tag="a"
            link="{{ $collectionLink }}"
            only-icon="true"
            size="small"
            color="dark"
            title="{{ __('shelf.on') }}">
            <x-slot:icon>
                <x-svg.check></x-svg.check>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badgeClass }}"
                    type="number"
                    align="standard"
                    color="success">
                    {{ $collection }}
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>
    @endif

    @if($wishlist)
        <x-ui.form.button
            class="counter-buttons__badge {{ $buttonClass }}"
            tag="a"
            link="{{ $wishlistLink }}"
            only-icon="true"
            size="small"
            color="dark"
            title="{{ __('common.wishful') }}">
            <x-slot:icon>
                <x-svg.wishlist></x-svg.wishlist>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badgeClass }}"
                    type="number"
                    align="standard"
                    color="success">
                    {{ $wishlist }}
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>
    @endif

    @if($sale)
        <x-ui.form.button
            class="counter-buttons__badge {{ $buttonClass }}"
            tag="a"
            link="{{ $saleLink }}"
            only-icon="true"
            size="small"
            color="dark"
            title="{{ __('common.sale') }}">
            <x-slot:icon>
                <x-svg.dollar></x-svg.dollar>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badgeClass }}"
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
            class="counter-buttons__badge {{ $buttonClass }}"
            tag="a"
            link="{{ $auctionLink }}"
            only-icon="true"
            size="small"
            color="dark"
            title="{{ __('common.auction') }}">
            <x-slot:icon>
                <x-svg.auction></x-svg.auction>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badgeClass }}"
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
            class="counter-buttons__badge {{ $buttonClass }}"
            tag="a"
            link="{{ $exchangeLink }}"
            only-icon="true"
            size="small"
            color="dark"
            title="{{ __('common.exchange') }}">
            <x-slot:icon>
                <x-svg.exchange></x-svg.exchange>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badgeClass }}"
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
            class="counter-buttons__badge {{ $buttonClass }}"
            tag="a"
            link="{{ $favoriteLink }}"
            only-icon="true"
            size="small"
            color="dark"
            title="{{ __('В избранном') }}">
            <x-slot:icon>
                <x-svg.star></x-svg.star>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badgeClass }}"
                    type="number"
                    align="standard"
                    color="success">
                    {{ $favorite }}
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>
    @endif
</div>
