@props([
    'title'
])

<div class="content__title">
    <x-ui.title tag="h1" size="big" >
        {{ $title }}
    </x-ui.title>

    <div class="content__title-buttons carrier__title-buttons">
        <x-ui.form.button
            class="carrier__title-button"
            tag="a"
            link="/"
            size="small"
            color="dark"
            mobile-icon="true"
            title="{{ __('На полках') }}">
                <x-slot:icon>
                    <x-svg.check></x-svg.check>
                </x-slot:icon>
                {{ __('На полках') }}
                <x-slot:badge>
                    <x-ui.badge
                        class="carrier__title-badge"
                        type="number"
                        align="standard"
                        color="success">
                        12
                    </x-ui.badge>
                </x-slot:badge>
        </x-ui.form.button>

        <x-ui.form.button
            class="carrier__title-button"
            tag="a"
            link="/"
            size="small"
            color="dark"
            mobile-icon="true"
            title="{{ __('Желают') }}">
            <x-slot:icon>
                <x-svg.wishlist></x-svg.wishlist>
            </x-slot:icon>
            {{ __('Желают') }}
            <x-slot:badge>
                <x-ui.badge
                    class="carrier__title-badge"
                    type="number"
                    align="standard"
                    color="success">
                    1200
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>

        <x-ui.form.button
            class="carrier__title-button"
            tag="a"
            link="/"
            size="small"
            color="dark"
            mobile-icon="true"
            title="{{ __('Продажа') }}">
            <x-slot:icon>
                <x-svg.dollar></x-svg.dollar>
            </x-slot:icon>
            {{ __('Продажа') }}
            <x-slot:badge>
                <x-ui.badge
                    class="carrier__title-badge"
                    type="number"
                    align="standard"
                    color="success">
                    5
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>

        <x-ui.form.button
            class="carrier__title-button"
            tag="a"
            link="/"
            size="small"
            color="dark"
            mobile-icon="true"
            title="{{ __('Аукционы') }}">
            <x-slot:icon>
                <x-svg.auction></x-svg.auction>
            </x-slot:icon>
            {{ __('Аукционы') }}
            <x-slot:badge>
                <x-ui.badge
                    class="carrier__title-badge"
                    type="number"
                    align="standard"
                    color="success">
                    2
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>

        <x-ui.form.button
            class="carrier__title-button"
            tag="a"
            link="/"
            size="small"
            color="dark"
            mobile-icon="true"
            title="{{ __('Обмен') }}">
            <x-slot:icon>
                <x-svg.exchange></x-svg.exchange>
            </x-slot:icon>
            {{ __('Обмен') }}
            <x-slot:badge>
                <x-ui.badge
                    class="carrier__title-badge"
                    type="number"
                    align="standard"
                    color="success">
                    2
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>

        <x-ui.form.button
            class="carrier__title-button"
            tag="a"
            link="/"
            size="small"
            color="dark"
            mobile-icon="true"
            title="{{ __('В избранном') }}">
            <x-slot:icon>
                <x-svg.star></x-svg.star>
            </x-slot:icon>
            {{ __('В избранном') }}
            <x-slot:badge>
                <x-ui.badge
                    class="carrier__title-badge"
                    type="number"
                    align="standard"
                    color="success">
                    153
                </x-ui.badge>
            </x-slot:badge>
        </x-ui.form.button>
    </div>
</div>
