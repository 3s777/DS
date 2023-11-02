@props([
    'button_class' => false,
    'badge_class' => false,
    'add' => false,
    'wishlist' => false,
    'sale' => false,
    'auction' => false,
    'exchange' => false,
    'favorite' => false
])

<div
    {{ $attributes->class([
            'counter-buttons'
        ])
    }}>
    @if($add)
        <x-ui.form.button
            class="counter-buttons__button {{ $button_class }}"
            tag="a"
            link="/"
            only_icon="true"
            size="small"
            color="dark"
            title="{{ __('На полках') }}">
            <x-slot:icon>
                <x-svg.check></x-svg.check>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badge_class }}"
                    type="number"
                    align="standard"
                    color="success">
                    {{ $add }}
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>
    @endif

    @if($wishlist)
        <x-ui.form.button
            class="counter-buttons__button {{ $button_class }}"
            tag="a"
            link="/"
            only_icon="true"
            size="small"
            color="dark"
            title="{{ __('Желают') }}">
            <x-slot:icon>
                <x-svg.wishlist></x-svg.wishlist>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badge_class }}"
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
            class="counter-buttons__button {{ $button_class }}"
            tag="a"
            link="/"
            only_icon="true"
            size="small"
            color="dark"
            title="{{ __('Продажа') }}">
            <x-slot:icon>
                <x-svg.dollar></x-svg.dollar>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badge_class }}"
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
            class="counter-buttons__button {{ $button_class }}"
            tag="a"
            link="/"
            only_icon="true"
            size="small"
            color="dark"
            title="{{ __('Аукционы') }}">
            <x-slot:icon>
                <x-svg.auction></x-svg.auction>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badge_class }}"
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
            class="counter-buttons__button {{ $button_class }}"
            tag="a"
            link="/"
            only_icon="true"
            size="small"
            color="dark"
            title="{{ __('Обмен') }}">
            <x-slot:icon>
                <x-svg.exchange></x-svg.exchange>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badge_class }}"
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
            class="counter-buttons__button {{ $button_class }}"
            tag="a"
            link="/"
            only_icon="true"
            size="small"
            color="dark"
            title="{{ __('В избранном') }}">
            <x-slot:icon>
                <x-svg.star></x-svg.star>
            </x-slot:icon>
            <x-slot:badge>
                <x-ui.badge
                    class="counter-buttons__badge {{ $badge_class }}"
                    type="number"
                    align="standard"
                    color="success">
                    {{ $favorite }}
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>
    @endif
</div>
