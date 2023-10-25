<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Search') }}</x-ui.title>
    <x-ui.card>
        <x-grid type="container">
            <x-grid.col xl="12" lg="12" md="12" sm="12">
                <x-ui.form.group>
                    <x-ui.search
                        link="/"
                        placeholder="{{ __('Standard search') }}"
                    ></x-ui.search>
                </x-ui.form.group>
                <x-ui.form.group>
                    <x-ui.search
                        link="/"
                        placeholder="{{ __('Light color search') }}"
                        color="light"
                    ></x-ui.search>
                </x-ui.form.group>
                <x-ui.form.group>
                    <x-ui.search
                        link="/"
                        placeholder="{{ __('Transparent search') }}"
                        color="transparent"
                    ></x-ui.search>
                </x-ui.form.group>
            </x-grid.col>
        </x-grid>
    </x-ui.card>
</section>
