<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               id="create-form"
               :action="route('collectibles.store')"
               enctype="multipart/form-data">
        <x-ui.title class="crud-form__tile" size="normal" indent="small">
            {{ __('collectible.add') }}
        </x-ui.title>

        <div class="crud-form__main">
            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('common.name', 1)"
                            id="name"
                            name="name"
                            required
                            autocomplete="on"
                            autofocus>
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="user_shelf"
                            select-name="user_shelf"
                            route="select-users"
                            :required="true"
                            :default-option="trans_choice('user.choose', 1)"
                            :label="trans_choice('user.users', 1)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async-depend
                            name="shelf"
                            select-name="shelf"
                            :required="true"
                            route="shelves.select"
                            depend-on="user_shelf"
                            depend-field="user_id"
                            :default-option="trans_choice('shelf.choose', 1)"
                            :label="trans_choice('shelf.shelves', 1)" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('common.article_numbers', 1)"
                            id="article_number"
                            name="article_number"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.enum
                            name="condition"
                            select-name="condition"
                            required
                            :options="$conditions"
                            :default-option="__('common.choose_condition')"
                            :placeholder="__('common.condition')" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('collectible.purchase_price', 1)"
                            id="price"
                            name="price"
                            type="number"
                            step="0.01"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('collectible.seller', 1)"
                            id="seller"
                            name="seller"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.datepicker
                            :placeholder="trans_choice('collectible.purchase_date', 1)"
                            id="purchase_date"
                            name="purchase_date">
                        </x-ui.form.datepicker>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" />

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.enum
                            name="collectable_type"
                            select-name="collectable_type"
                            required
                            :options="$types"
                            :name-as-value="true"
                            :default-option="__('collectible.choose_type')"
                            :placeholder="trans_choice('collectible.choose_type', 1)" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async-depend
                            name="media"
                            select-name="media"
                            :required="true"
                            route="collectibles.select.media"
                            depend-on="collectable_type"
                            depend-field="media"
                            :default-option="trans_choice('collectible.choose_media', 1)"
                            :label="trans_choice('collectible.media', 1)" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <div id="properties"></div>
                    </x-ui.form.group>
                </x-grid.col>

            </x-grid>
        </div>

        <div class="crud-form__description">
            <x-ui.form.group>
                <x-libraries.rich-text-editor
                    name="description"
                    value=""
                    :placeholder="__('common.description')"/>
            </x-ui.form.group>
        </div>

        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                <x-ui.form.input-image
                    class="crud-form__input-image"
                    name="thumbnail"
                    id="thumbnail">
                    <p>{{ __('common.file.format') }} jpg, png</p>
                    <p>{{ __('common.file.max_size') }} 6Mb</p>
                </x-ui.form.input-image>
            </div>
        </div>

        <x-ui.form.group class="crud-form__submit">
            <x-ui.form.button
                class="crud-form__submit-button"
                x-bind:disabled="preventSubmit">
                    {{ __('common.save') }}
            </x-ui.form.button>
        </x-ui.form.group>

    </x-ui.form>
    @push('scripts')
        <script>
            document.getElementById('media-select').addEventListener('change', async function() {
                console.log('You selected: ', this.value);
                try {
                    const media = this.value ?? null
                    const model = document.getElementById('collectable_type')
                    const response = await axios.post('{{ route('collectibles.get.media') }}', {
                        media: media,
                        model: model.value
                    });
                    console.log(response.data);
                    const properties = document.getElementById('properties')
                    properties.innerHTML = response.data;
                    return response.data.result;
                } catch (err) {
                    @if(!app()->isProduction())
                    console.log(err);
                    @endif
                }
            });
        </script>
    @endpush
</x-layouts.admin>
