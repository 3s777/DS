<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Star rating') }}</x-ui.title>
    <x-ui.card>
        <x-grid>
            <x-grid.col xl="4" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.star-rating
                        class="ui__add-rating"
                        num-class="10"
                        title="Star rating 1"
                        name="cover">
                    </x-ui.star-rating>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.star-rating
                        hide-none-button="true"
                        count="5"
                        class="ui__add-rating"
                        title="Star rating 2"
                        name="cover1">
                    </x-ui.star-rating>
                </x-ui.form.group>
            </x-grid.col>

        </x-grid>
    </x-ui.card>
</section>
