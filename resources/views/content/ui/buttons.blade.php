<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Buttons') }}</x-ui.title>
    <x-ui.card>
        <x-grid type="container" class="grid grid_container">
            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true">
                        {{ __('Submit') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true"
                        color="cancel">
                        {{ __('Cancel') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true"
                        color="disabled"
                        disabled>
                        {{ __('Disabled') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true"
                        color="light">
                        {{ __('Light') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true"
                        color="dark">
                        {{ __('Dark') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true">
                        <x-slot:icon class="button__icon-wrapper_submit">
                            <x-svg.success class="button__submit-icon"></x-svg.success>
                        </x-slot:icon>
                        {{ __('With icon') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        mobile_icon="true">
                        <x-slot:icon>
                            <x-svg.success class="button__submit-icon"></x-svg.success>
                        </x-slot:icon>
                        {{ __('Mobile icon') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true"
                        color="cancel">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.cancel class="button__cancel-icon"></x-svg.cancel>
                        </x-slot:icon>
                        {{ __('With icon') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true"
                        color="dark">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.warning class="button__cancel-icon"></x-svg.warning>
                        </x-slot:icon>
                        {{ __('Dark') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true">
                        {{ __('Normal size') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true">
                        {{ __('Full width button') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button>
                        {{ __('Content width button') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button>
                        <x-slot:icon class="button__icon-wrapper_submit">
                            <x-svg.success class="button__submit-icon"></x-svg.success>
                        </x-slot:icon>
                        {{ __('Content width button') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        size="small">
                        {{ __('Small size') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true"
                        size="big">
                        {{ __('Big size') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true"
                        color="cancel"
                        icon_size="big"
                        size="big">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.cancel class="button__cancel-icon"></x-svg.cancel>
                        </x-slot:icon>
                        {{ __('Big size') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        full_width="true"
                        size="large">
                        {{ __('Large size') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button
                        tag="a"
                        link="/"
                        full_width="true"
                        color="cancel"
                        icon_size="large"
                        size="large">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.cancel class="button__cancel-icon"></x-svg.cancel>
                        </x-slot:icon>
                        {{ __('Large size') }}
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="6" lg="6" md="6" sm="12">
                <x-ui.form.group class="ui__form-group_buttons">

                    <x-ui.form.button
                        color="info"
                        only_icon="true"
                        size="extra-small">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.view class="button__icon button__icon_extra-small button__view-icon"></x-svg.view>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="warning"
                        only_icon="true"
                        size="extra-small">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.edit class="button__icon button__icon_extra-small button__edit-icon"></x-svg.edit>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="cancel"
                        only_icon="true"
                        size="extra-small">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.close class="button__icon button__icon_extra-small button__close-icon"></x-svg.close>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="info"
                        only_icon="true"
                        size="small">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.view class="button__icon button__icon_small button__view-icon"></x-svg.view>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="warning"
                        only_icon="true"
                        size="small">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.edit class="button__icon button__icon_small button__edit-icon"></x-svg.edit>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="cancel"
                        only_icon="true"
                        size="small">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.close class="button__icon button__icon_small button__close-icon"></x-svg.close>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="info"
                        only_icon="true">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.view class="button__icon button__view-icon"></x-svg.view>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="cancel"
                        only_icon="true">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.close class="button__icon button__close-icon"></x-svg.close>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="warning"
                        only_icon="true"
                        size="big">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.edit class="button__icon button__icon_big button__edit-icon"></x-svg.edit>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="cancel"
                        only_icon="true"
                        size="big">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.close class="button__icon button__icon_big button__close-icon"></x-svg.close>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="info"
                        only_icon="true"
                        size="large">
                        <x-slot:icon class="button__icon-wrapper_cancel">
                            <x-svg.cancel class="button__icon button__icon_large button__close-icon"></x-svg.cancel>
                        </x-slot:icon>
                    </x-ui.form.button>

                    <x-ui.form.button
                        tooltip="true"
                        color="info">
                        ?
                    </x-ui.form.button>

                    <x-ui.form.button
                        tooltip="true"
                        tooltip_size="extra_small">
                        ?
                    </x-ui.form.button>

                    <x-ui.form.button
                        color="cancel"
                        tooltip="true"
                        tooltip_size="big">
                        ?
                    </x-ui.form.button>

                </x-ui.form.group>
            </x-grid.col>

        </x-grid>
    </x-ui.card>
</section>
