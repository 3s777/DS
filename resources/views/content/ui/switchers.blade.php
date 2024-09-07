<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Switchers') }}</x-ui.title>
    <x-ui.card>
        <x-grid type="container">
            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.input-checkbox
                        id="remember"
                        name="remember"
                        label="{{ __('Remember me') }}"
                    >
                    </x-ui.form.input-checkbox>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.switcher
                        name="switcher1"
                        label="{{ __('Switcher Off') }}"
                    >
                    </x-ui.form.switcher>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.switcher
                        name="switcher2"
                        label="{{ __('Switcher On') }}"
                        checked
                    >
                    </x-ui.form.switcher>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.switcher
                        name="switcher3"
                        label="{{ __('Switcher Disabled') }}"
                        disabled
                    >
                    </x-ui.form.switcher>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <nav>
                        <x-ui.form.radio
                            id="a-opt"
                            name="choice"
                            label="radio switcher"
                        >
                        </x-ui.form.radio>

                        <x-ui.form.radio
                            id="b-opt"
                            name="choice"
                            label="radio switcher 2"
                            checked
                        >
                        </x-ui.form.radio>

                        <x-ui.form.radio
                            id="c-opt"
                            name="choice"
                            label="radio switcher 3"
                        >
                        </x-ui.form.radio>

                        <x-ui.form.radio
                            id="c-opt"
                            name="choice"
                            label="radio switcher disabled"
                            disabled
                        >
                        </x-ui.form.radio>
                    </nav>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="9" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.radio-button
                        id="radio-1"
                        name="radio"
                        value="1"
                        color="dark"
                        indent="right"
                        checked="true"
                        label="{{ __('Radio button 1') }}">
                    </x-ui.form.radio-button>

                    <x-ui.form.radio-button
                        id="radio-2"
                        name="radio"
                        value="2"
                        color="dark"
                        indent="right"
                        label="{{ __('Radio button 2') }}">
                    </x-ui.form.radio-button>

                    <x-ui.form.radio-button
                        id="radio-3"
                        name="radio"
                        value="3"
                        color="dark"
                        indent="right"
                        label="{{ __('Radio button 3') }}">
                    </x-ui.form.radio-button>

                    <x-ui.form.radio-button
                        id="radio-4"
                        name="radio"
                        value="4"
                        color="disabled"
                        indent="right"
                        label="{{ __('Disabled') }}">
                    </x-ui.form.radio-button>
                </x-ui.form.group>

                <x-ui.form.group>
                    <x-ui.form.radio-group>

                        <x-ui.form.radio-button
                            class="radio-group__button"
                            id="radio-11"
                            name="radio"
                            value="11"
                            color="dark"
                            checked="true"
                            label-class="radio-group__label"
                            label="{{ __('Radio button 1') }}">
                        </x-ui.form.radio-button>

                        <x-ui.form.radio-button
                            class="radio-group__button"
                            id="radio-12"
                            name="radio"
                            value="12"
                            color="dark"
                            label-class="radio-group__label"
                            label="{{ __('Radio button 2') }}">
                        </x-ui.form.radio-button>

                        <x-ui.form.radio-button
                            class="radio-group__button"
                            id="radio-13"
                            name="radio"
                            value="13"
                            color="dark"
                            label-class="radio-group__label"
                            label="{{ __('Radio button 3') }}">
                        </x-ui.form.radio-button>

                        <x-ui.form.radio-button
                            class="radio-group__button"
                            id="radio-14"
                            name="radio"
                            value="14"
                            color="disabled"
                            label-class="radio-group__label"
                            label="{{ __('Disabled') }}">
                        </x-ui.form.radio-button>

                    </x-ui.form.radio-group>
                </x-ui.form.group>
            </x-grid.col>

        </x-grid>
    </x-ui.card>
</section>
