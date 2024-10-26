<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               id="create-form"
               :action="route('collectibles.store.game')"
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
                            :value="old('name')"
                            required
                            autocomplete="on"
                            autofocus>
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="user_shelf_id"
                            select-name="user_shelf_id"
                            route="select-users"
                            :required="true"
                            :default-option="trans_choice('user.choose', 1)"
                            :label="__('shelf.user')">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-depend
                            name="shelf"
                            select-name="shelf_id"
                            :required="true"
                            route="shelves.select"
                            depend-on="user_shelf_id"
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
                            :value="old('article_number')"
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
                            :label="__('common.choose_condition')"
                            :placeholder="__('common.condition')" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('collectible.purchase_price', 1)"
                            id="purchase_price"
                            name="purchase_price"
                            type="number"
                            step="0.01"
                            :value="old('purchase_price')"
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
                            :value="old('seller')"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.datepicker
                            :placeholder="trans_choice('collectible.purchased_at', 1)"
                            id="purchased_at"
                            name="purchased_at"
                            :value="old('purchased_at')">
                        </x-ui.form.datepicker>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="user"
                            select-name="user_id"
                            route="select-users"
                            :default-option="trans_choice('user.choose', 1)"
                            :label="trans_choice('user.users', 1)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>

            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('common.additional_fields', 1)"
                            id="additional"
                            name="additional"
                            :value="old('additional')"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.switcher
                            name="properties[is_done]"
                            value="1"
                            :checked="old('is_done')"
                            label="{{ __('game.is_done') }}">
                        </x-ui.form.switcher>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.switcher
                            name="properties[is_digital]"
                            value="1"
                            :checked="old('is_digital')"
                            label="{{ __('game.is_digital') }}">
                        </x-ui.form.switcher>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>

            <x-grid type="container">
                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="media"
                            select-name="media"
                            :required="true"
                            route="game-media.select"
                            :default-option="trans_choice('collectible.choose_media', 1)"
                            :label="trans_choice('collectible.media', 1)" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="5" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <div id="kit" class="admin__conditions"></div>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>

            <div class="collectible-target">
                <x-grid type="container">
                    <x-grid.col xl="12" ls="12" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.radio-group>
                                <x-ui.form.radio-button
                                    id="radio-collection"
                                    name="target"
                                    value="collection"
                                    color="dark"
                                    :checked="old() ? old('target') == 'collection' : true"
                                    :group="true"
                                    label="{{ __('common.for_collection') }}">
                                </x-ui.form.radio-button>

                                <x-ui.form.radio-button
                                    id="radio-sale"
                                    name="target"
                                    value="sale"
                                    color="dark"
                                    :group="true"
                                    :checked="old('target') == 'sale'"
                                    label="{{ __('common.for_sale') }}">
                                </x-ui.form.radio-button>

                                <x-ui.form.radio-button
                                    id="radio-auction"
                                    name="target"
                                    value="auction"
                                    color="dark"
                                    :group="true"
                                    :checked="old('target') == 'auction'"
                                    label="{{ __('common.for_auction') }}">
                                </x-ui.form.radio-button>

                                <x-ui.form.radio-button
                                    id="radio-exchange"
                                    name="target"
                                    value="exchange"
                                    color="dark"
                                    :group="true"
                                    :checked="old('target') == 'exchange'"
                                    label="{{ __('common.for_exchange') }}">
                                </x-ui.form.radio-button>
                            </x-ui.form.radio-group>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>

                <div class="collectible-target__fields collectible-target__sale" style="display: none">
                    <x-grid type="container">
                        <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    placeholder="{{ __('collectible.sale_price') }} *"
                                    id="sale_price"
                                    name="sale[price]"
                                    step="0.01"
                                    value="{{ old('sale_price') }}"
                                    type="number"
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>
                    </x-grid>
                </div>
                <div class="collectible-target__fields collectible-target__auction" style="display: none">
                    <x-grid type="container">
                        <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    placeholder="{{ __('collectible.auction_price') }} *"
                                    id="auction_price"
                                    name="auction[price]"
                                    step="0.01"
                                    value="{{ old('auction_price') }}"
                                    type="number"
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    placeholder="{{ __('collectible.auction_step') }} *"
                                    id="auction_step"
                                    name="auction[step]"
                                    step="0.01"
                                    value="{{ old('auction_step') }}"
                                    type="number"
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.datepicker
                                    placeholder="{{ __('collectible.auction_to') }} *"
                                    id="auction_to"
                                    name="auction[to]"
                                    :value="old('auction_to')">
                                </x-ui.form.datepicker>
                            </x-ui.form.group>
                        </x-grid.col>
                    </x-grid>
                </div>
            </div>
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
@dump(old())
    </x-ui.form>


    @push('scripts')
        <script>
            var targets = document.querySelectorAll('input[type=radio][name="target"]');

            function hideTarget() {
                document.querySelectorAll('.collectible-target__fields').forEach(function(el) {
                    el.style.display = 'none';
                });
            }

            function setTargetSale() {
                document.querySelectorAll('.collectible-target__sale').forEach(function(el) {
                    el.style.display = 'block';
                });
            }

            function setTargetAuction() {
                document.querySelectorAll('.collectible-target__auction').forEach(function(el) {
                    el.style.display = 'block';
                });
            }

            @if(old('target'))
                targets.forEach( target => {
                    hideTarget();

                    @if(old('target') == 'sale')
                        setTargetSale();
                    @endif

                    @if(old('target') == 'auction')
                        setTargetAuction();
                    @endif
                })
            @endif

            targets.forEach(target => target.addEventListener('change',
                function() {
                    hideTarget();

                    if(target.value === 'sale') {
                        setTargetSale();
                    }

                    if(target.value === 'auction') {
                        setTargetAuction();
                    }
                }
            ));

            async function setKit(mediaValue) {
                try {
                    const media = mediaValue ?? null
                    const response = await axios.post('{{ route('collectibles.get.media') }}', {
                        media: media,
                        model: 'Game'
                    });
                    const kit = document.getElementById('kit')
                    kit.innerHTML = response.data;

                    @if(old('kit_conditions'))
                        @foreach(old('kit_conditions') as $key => $value)
                            document.getElementById("star-rating_{{$key}}-{{$value}}").checked = true;
                        @endforeach
                    @endif

                    return response.data.result;
                } catch (err) {
                    @if(!app()->isProduction())
                        console.log(err);
                    @endif
                }
            }

            const mediaSelect = document.getElementById('media-select');

            window.addEventListener("load", (event) => {
                if(mediaSelect.value !== '') {
                    setKit(mediaSelect.value);
                }
            });

            mediaSelect.addEventListener('change', async function() {
                setKit(this.value);
            });
        </script>
    @endpush
</x-layouts.admin>
