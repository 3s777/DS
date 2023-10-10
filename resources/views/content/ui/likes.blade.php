<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Likes') }}</x-ui.title>
    <x-ui.card>
        <x-grid>
            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.like
                        count="12"
                        size="small"
                        type="like">
                        <x-svg.like class="like__icon"></x-svg.like>
                    </x-ui.like>
                    <x-ui.like
                        count="12"
                        size="small"
                        status="active"
                        type="like">
                        <x-svg.like class="like__icon"></x-svg.like>
                    </x-ui.like>
                </x-ui.form.group>
            </x-grid.col>

        </x-grid>
    </x-ui.card>
</section>
