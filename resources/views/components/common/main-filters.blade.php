<div class="container">
    <div class="main-filters" x-data x-cloak x-show="!$store.mainFilters.hide" x-transition.scale.right>
        @if($slot->isNotEmpty())
            {{ $slot }}
        @else
            <x-grid type="container">
                <x-grid.col xl="3" lg="4"  md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-select-auto"
                            id="select-test"
                            name="select-test"
                            label="Платформа">
                            <x-ui.form.option value="1">Playstation 3</x-ui.form.option>
                            <x-ui.form.option value="1">Xbox 360</x-ui.form.option>
                            <x-ui.form.option value="2">NES</x-ui.form.option>
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="3" lg="4"  md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-select-auto"
                            id="select-test"
                            name="select-test"
                            label="Тип издания">
                            <x-ui.form.option value="1">Classic</x-ui.form.option>
                            <x-ui.form.option value="1">Essentials</x-ui.form.option>
                            <x-ui.form.option value="2">Platinum</x-ui.form.option>
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="3" lg="4"  md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-select-auto"
                            id="select-test"
                            name="select-test"
                            label="Разработчик">
                            <x-ui.form.option value="1">Capcom</x-ui.form.option>
                            <x-ui.form.option value="1">Rockstar</x-ui.form.option>
                            <x-ui.form.option value="2">Insomniac</x-ui.form.option>
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="3" lg="4"  md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-select-auto"
                            id="select-test"
                            name="select-test"
                            label="Издатель">
                            <x-ui.form.option value="1">Capcom</x-ui.form.option>
                            <x-ui.form.option value="1">Rockstar</x-ui.form.option>
                            <x-ui.form.option value="2">Insomniac</x-ui.form.option>
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="3" lg="4"  md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-select-auto"
                            id="select-test"
                            name="select-test"
                            label="Жанр">
                            <x-ui.form.option value="1">Платформер</x-ui.form.option>
                            <x-ui.form.option value="1">FPS</x-ui.form.option>
                            <x-ui.form.option value="2">Головоломка</x-ui.form.option>
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="3" lg="4"  md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-select-auto"
                            id="select-test"
                            name="select-test"
                            label="Язык">
                            <x-ui.form.option value="1">Английский</x-ui.form.option>
                            <x-ui.form.option value="1">Русский</x-ui.form.option>
                            <x-ui.form.option value="2">Японский</x-ui.form.option>
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="3" lg="4"  md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            placeholder="Год выхода"
                            id="text"
                            name="text"
                            value="{{ old('text') }}"
                            type="number"
                            min="1950"
                            max="2100"
                            required
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="12"  md="12" sm="12">
                    <x-ui.form.group>
                        <div class="main-filters__footer">
                            <x-ui.form.button>{{ __('Отфильтровать') }}</x-ui.form.button>
                            <x-ui.form.button color="warning">{{ __('Сбросить') }}</x-ui.form.button>
                            <x-ui.form.button color="cancel" x-on:click="$store.mainFilters.hide = true">{{ __('Закрыть') }}</x-ui.form.button>
                        </div>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
       @endif
    </div>
</div>
