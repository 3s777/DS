<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('admin.collectibles.store.game')"
        :title="__('collectible.add')"
        :images="true">
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
                        name="collector_id"
                        select-name="collector_id"
                        route="admin.select-collectors"
                        :required="true"
                        :default-option="trans_choice('user.collector.choose', 1)"
                        :label="__('shelf.collector')">
                    </x-ui.select.async>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                <x-ui.form.group>
                    <x-ui.select.data-depend
                        name="shelf"
                        select-name="shelf_id"
                        :required="true"
                        route="admin.shelves.select"
                        depend-on="collector_id"
                        depend-field="collector_id"
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
                        :label="__('common.choose_condition')"
                        :placeholder="__('common.condition')" />
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.input-text
                        :placeholder="__('collectible.purchase_price')"
                        id="purchase_price"
                        name="purchase_price"
                        type="number"
                        step="0.01"
                        min="0"
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.input-text
                        :placeholder="__('collectible.seller')"
                        id="seller"
                        name="seller"
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.datepicker
                        :placeholder="__('collectible.purchased_at')"
                        id="purchased_at"
                        name="purchased_at">
                    </x-ui.form.datepicker>
                </x-ui.form.group>
            </x-grid.col>
        </x-grid>

        <x-grid type="container">
            <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.input-text
                        :placeholder="trans_choice('common.additional_fields', 1)"
                        id="additional_field"
                        name="additional_field"
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                <x-ui.form.group>
                    <x-ui.form.switcher
                        name="properties[is_done]"
                        value="1"
                        :label="__('game.is_done')">
                    </x-ui.form.switcher>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                <x-ui.form.group>
                    <x-ui.form.switcher
                        name="properties[is_digital]"
                        value="1"
                        :label="__('game.is_digital')">
                    </x-ui.form.switcher>
                </x-ui.form.group>
            </x-grid.col>
        </x-grid>

        <x-grid type="container">
            <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                <x-ui.form.group>
                    <x-ui.select.async
                        name="collectable"
                        select-name="collectable"
                        :required="true"
                        route="game-media.select"
                        :default-option="trans_choice('collectible.choose_collectable', 1)"
                        :label="trans_choice('collectible.collectable', 1)" />
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
                                :checked="true"
                                :group="true"
                                :label="__('common.for_collection')">
                            </x-ui.form.radio-button>

                            <x-ui.form.radio-button
                                id="radio-sale"
                                name="target"
                                value="sale"
                                color="dark"
                                :group="true"
                                :label="__('common.for_sale')">
                            </x-ui.form.radio-button>

                            <x-ui.form.radio-button
                                id="radio-auction"
                                name="target"
                                value="auction"
                                color="dark"
                                :group="true"
                                :label="__('common.for_auction')">
                            </x-ui.form.radio-button>

                            <x-ui.form.radio-button
                                id="radio-exchange"
                                name="target"
                                value="exchange"
                                color="dark"
                                :group="true"
                                :label="__('common.for_exchange')">
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
                                placeholder="{{ __('collectible.sale.price') }} *"
                                id="sale_price"
                                name="sale[price]"
                                step="0.01"
                                min="0"
                                type="number"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>
                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                placeholder="{{ __('collectible.sale.price_old') }} *"
                                id="sale_price_old"
                                name="sale[price_old]"
                                step="0.01"
                                min="0"
                                type="number"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                placeholder="{{ __('common.quantity') }} *"
                                id="sale_quantity"
                                name="sale[quantity]"
                                step="1"
                                min="1"
                                value="1"
                                type="number"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.select.enum
                                name="sale_reservation"
                                select-name="sale[reservation]"
                                id="sale_reservation"
                                :options="$reservation"
                                selected="none"
                                :label="__('collectible.reservation.choose')"/>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.switcher
                                name="sale[bidding]"
                                value="1"
                                :label="__('collectible.sale.bidding')">
                            </x-ui.form.switcher>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>
            </div>
            <div class="collectible-target__fields collectible-target__auction" style="display: none">
                <x-grid type="container">
                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                placeholder="{{ __('collectible.auction.price') }} *"
                                id="auction_price"
                                name="auction[price]"
                                step="0.01"
                                min="0"
                                type="number"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                placeholder="{{ __('collectible.auction.step') }} *"
                                id="auction_step"
                                name="auction[step]"
                                step="0.01"
                                min="0"
                                type="number"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.datepicker
                                placeholder="{{ __('collectible.auction.finished_at') }} *"
                                id="auction_finished_at"
                                :time="true"
                                name="auction[finished_at]">
                            </x-ui.form.datepicker>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                placeholder="{{ __('collectible.auction.blitz') }}"
                                id="auction_blitz"
                                name="auction[blitz]"
                                step="0.01"
                                min="0"
                                type="number"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                placeholder="{{ __('collectible.auction.renewal') }}"
                                id="auction_renewal"
                                name="auction[renewal]"
                                step="1"
                                min="0"
                                type="number"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>
            </div>

            <div class="collectible-target__fields collectible-target__shipping" id="collectible-target__shipping" style="display: none">
                <x-grid type="container">
                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.select.data
                                name="country_id"
                                select-name="country_id"
                                id="country_id"
                                :options="$countries"
                                :label="trans_choice('settings.country.choose', 1)"
                                :default-option="trans_choice('settings.country.countries', 1)"
                            />
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.select.enum
                                name="shipping"
                                select-name="shipping"
                                id="shipping"
                                :options="$shipping"
                                selected="country"
                                :label="__('collectible.shipping.option')"/>
                        </x-ui.form.group>
                    </x-grid.col>


                        <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12" id="shipping_countries_block" style="display: none">
                            <x-ui.form.group>
                                <x-ui.select.data-multiple
                                    name="shipping_countries"
                                    select-name="shipping_countries[]"
                                    id="shipping_countries"
                                    :options="$countries"
                                    :label="__('collectible.shipping.choose_countries')"
                                    :default-option="trans_choice('settings.country.countries', 2)"
                                />
                            </x-ui.form.group>
                        </x-grid.col>


                    <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.switcher
                                name="self_delivery"
                                value="1"
                                :checked="true"
                                :label="__('collectible.shipping.self_delivery')">
                            </x-ui.form.switcher>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>
            </div>
        </div>

        <x-slot:sidebar></x-slot:sidebar>
    </x-admin.crud-form>

    @push('scripts')
        <script>
            var targets = document.querySelectorAll('input[type=radio][name="target"]');

            const shipping = document.getElementById('collectible-target__shipping');

            function hideTarget() {
                document.querySelectorAll('.collectible-target__fields').forEach(function(el) {
                    el.style.display = 'none';
                });

                shipping.style.display = 'none';
            }

            function setTargetSale() {
                document.querySelectorAll('.collectible-target__sale').forEach(function(el) {
                    el.style.display = 'block';
                });

                shipping.style.display = 'block';
            }

            function setTargetAuction() {
                document.querySelectorAll('.collectible-target__auction').forEach(function(el) {
                    el.style.display = 'block';
                });

                shipping.style.display = 'block';
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
                    const response = await axios.post('{{ route('admin.kit-items.get.html-conditions') }}', {
                        media: media,
                        model: 'Game'
                    });
                    const kit = document.getElementById('kit')
                    kit.innerHTML = response.data.html;

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

            const collectableSelect = document.getElementById('collectable-select');

            window.addEventListener("load", (event) => {
                if(collectableSelect.value !== '') {
                    setKit(collectableSelect.value);
                }
            });

            collectableSelect.addEventListener('change', async function() {
                setKit(this.value);
            });

            const shippingSelect = document.getElementById('shipping');
            const shippingCountries = document.getElementById('shipping_countries_block');

            if(shippingSelect.value === 'selected') {
                shippingCountries.style.display = 'block';
            } else {
                shippingCountries.style.display = 'none';
            }

            shippingSelect.addEventListener('change', function handleChange(event) {
                if(event.target.value === 'selected') {
                    shippingCountries.style.display = 'block';
                } else {
                    shippingCountries.style.display = 'none';
                }
            });
        </script>
    @endpush
</x-layouts.admin>
