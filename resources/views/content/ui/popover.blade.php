<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Popover') }}</x-ui.title>

    <x-ui.card>
        <x-grid type="container">
            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <div class="ui__item-wrapper">
                    <x-ui.popover
                        class="ui__popover"
                        content-class="popover__content_test"
                        title="{{ __('Popover title') }}"
                        tail="none">
                        Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                    </x-ui.popover>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <div class="ui__item-wrapper">
                    <x-ui.popover
                        class="ui__popover"
                        content-class="popover__content_test"
                        title="{{ __('Popover title') }}">
                        Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                        <x-slot:close x-on:click="show_message = ! show_message">
                            <x-svg.close class="popover__close-icon"></x-svg.close>
                        </x-slot:close>
                    </x-ui.popover>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <div class="ui__item-wrapper">
                    <x-ui.popover
                        class="ui__popover"
                        content-class="popover__content_test"
                        title="{{ __('Popover title') }}"
                        tail="left">
                        Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                        <x-slot:close x-on:click="show_message = ! show_message">
                            <x-svg.close class="popover__close-icon"></x-svg.close>
                        </x-slot:close>
                    </x-ui.popover>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <div class="ui__item-wrapper">
                    <x-ui.popover
                        class="ui__popover"
                        content-class="popover__content_test"
                        title="{{ __('Popover title') }}"
                        tail="right">
                        Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                        <x-slot:close x-on:click="show_message = ! show_message">
                            <x-svg.close class="popover__close-icon"></x-svg.close>
                        </x-slot:close>
                    </x-ui.popover>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <div class="ui__item-wrapper">
                    <x-ui.popover
                        class="ui__popover"
                        content-class="popover__content_test"
                        title="{{ __('Popover title') }}">
                        Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                        <x-slot:footer>
                            <x-ui.popover.buttons align="center">
                                <x-ui.form.button class="popover__button" size="small">Submit</x-ui.form.button>
                                <x-ui.form.button class="popover__button" color="cancel" size="small">Cancel</x-ui.form.button>
                            </x-ui.popover.buttons>
                        </x-slot:footer>
                        <x-slot:close x-on:click="show_message = ! show_message">
                            <x-svg.close class="popover__close-icon"></x-svg.close>
                        </x-slot:close>
                    </x-ui.popover>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <div class="ui__item-wrapper">
                    <x-ui.popover
                        class="ui__popover"
                        content-class="popover__content_test"
                        title="{{ __('Popover title') }}">
                        Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                        <x-slot:footer>
                            <x-ui.popover.buttons>
                                <x-ui.form.button class="popover__button" size="small">Submit</x-ui.form.button>
                                <x-ui.form.button class="popover__button" color="cancel" size="small">Cancel</x-ui.form.button>
                            </x-ui.popover.buttons>
                        </x-slot:footer>
                        <x-slot:close x-on:click="show_message = ! show_message">
                            <x-svg.close class="popover__close-icon"></x-svg.close>
                        </x-slot:close>
                    </x-ui.popover>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <div class="ui__item-wrapper">
                    <div class="ui__popover-test" x-data="{ testPopoverHidden: true }">
                        <x-ui.form.button x-on:click.stop="testPopoverHidden = ! testPopoverHidden">Click me for popover</x-ui.form.button>
                        <x-ui.popover
                            x-on:click.outside="testPopoverHidden = true" ::class="testPopoverHidden ? '' : 'popover_visible'"
                            class="popover_hidden ui__popover_visible"
                            content-class="popover__content_test"
                            title="{{ __('Popover title') }}"
                            tail="left">
                            Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                            <x-slot:close x-on:click="testPopoverHidden = true">
                                <x-svg.close class="popover__close-icon"></x-svg.close>
                            </x-slot:close>
                        </x-ui.popover>
                    </div>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <div class="ui__item-wrapper">
                    <x-ui.form.button
                        class="tooltip_trigger"
                        color="info"
                        tooltip="true"
                        data-tooltip="tooltip_1">
                        ?
                    </x-ui.form.button>
                    <x-ui.tooltip
                        class="tooltip_1"
                        id="tooltip">
                        Big tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip
                    </x-ui.tooltip>

                    <x-ui.form.button
                        class="tooltip_trigger"
                        color="cancel"
                        tooltip-size="big"
                        tooltip="true"
                        data-tooltip="tooltip_2">
                        ?
                    </x-ui.form.button>
                    <x-ui.tooltip
                        class="tooltip_2"
                        id="tooltip2">
                        Big tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip
                    </x-ui.tooltip>

                    <x-ui.form.button
                        class="tooltip_trigger"
                        tooltip-size="extra-small"
                        tooltip="true"
                        data-tooltip="tooltip_3">
                        ?
                    </x-ui.form.button>
                    <x-ui.tooltip
                        class="tooltip_3"
                        id="tooltip3">
                        Big tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip
                    </x-ui.tooltip>
                </div>
            </x-grid.col>

        </x-grid>
    </x-ui.card>
</section>
