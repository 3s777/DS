<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Filepond') }}</x-ui.title>
    <x-ui.card>
        <x-grid>
            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <x-libraries.filepond
                    class="filepond1"
                    name="filepond"
                    accept="image/png, image/jpeg, image/gif"
                    multiple>
                </x-libraries.filepond>
            </x-grid.col>
            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <x-libraries.filepond
                    class="filepond2"
                    name="filepond"
                    multiple
                    data-allow-reorder="true"
                    data-max-file-size="3MB"
                    data-max-files="3">
                </x-libraries.filepond>
            </x-grid.col>
            <x-grid.col xl="2" lg="6" md="6" sm="12">
                <x-libraries.filepond
                    class="filepond3"
                    name="filepond"
                    accept="image/png, image/jpeg, image/gif"
                    data-allow-reorder="true"
                    data-max-file-size="3MB">
                </x-libraries.filepond>
            </x-grid.col>
        </x-grid>
    </x-ui.card>
</section>
