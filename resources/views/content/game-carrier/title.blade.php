<div class="content__title">
    <x-ui.title tag="h1" size="big" >
        {{ __('BLES00789, Resonance of Fate, Playstation 3') }}
    </x-ui.title>

    <div class="content__title-buttons carrier__title-buttons">
        <x-ui.form.button class="carrier__title-button" tag="a" size="small" color="dark">
            {{ __('На полках') }}
            <x-ui.badge
                class="carrier__title-badge"
                type="number"
                align="standard"
                color="success">
                12
            </x-ui.badge>
        </x-ui.form.button>
        <x-ui.form.button class="carrier__title-button" tag="a" href="/" size="small" color="dark">
            {{ __('Желают') }}
            <x-ui.badge
                class="carrier__title-badge"
                type="number"
                align="standard"
                color="success">
                1200
            </x-ui.badge>
        </x-ui.form.button>
        <x-ui.form.button class="carrier__title-button" tag="a" href="/" size="small" color="dark">
            {{ __('Продажа') }}
            <x-ui.badge
                class="carrier__title-badge"
                type="number"
                align="standard"
                color="success">
                5
            </x-ui.badge>
        </x-ui.form.button>
        <x-ui.form.button class="carrier__title-button" tag="a" href="/" size="small" color="dark">
            {{ __('Аукционы') }}
            <x-ui.badge
                class="carrier__title-badge"
                type="number"
                align="standard"
                color="success">
                2
            </x-ui.badge>
        </x-ui.form.button>
        <x-ui.form.button class="carrier__title-button" tag="a" href="/" size="small" color="dark">
            {{ __('Обмен') }}
            <x-ui.badge
                class="carrier__title-badge"
                type="number"
                align="standard"
                color="success">
                2
            </x-ui.badge>
        </x-ui.form.button>
        <x-ui.form.button class="carrier__title-button" tag="a" size="small" color="dark" not_clickable="true">
            {{ __('В избранном') }}
            <x-ui.badge
                class="carrier__title-badge"
                type="number"
                align="standard"
                color="success">
                153
            </x-ui.badge>
        </x-ui.form.button>
    </div>
</div>
