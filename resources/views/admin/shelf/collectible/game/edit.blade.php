<x-layouts.admin :search="false">
    <x-admin.crud-form
       :action="route('admin.collectibles.update.game', $collectible->id)"
       :title="__('collectible.edit')"
       :model="$collectible"
       :images="true">
            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('common.name', 1)"
                            id="name"
                            name="name"
                            :value="$collectible->name"
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
                            :selected="$selectedCollector"
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
                            :selected="$collectible->shelf->id"
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
                            :value="$collectible->article_number"
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
                            :selected="$collectible->condition"
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
                            :value="$collectible->purchase_price->value()"
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
                            :value="$collectible->seller"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.datepicker
                            :placeholder="__('collectible.purchased_at')"
                            id="purchased_at"
                            name="purchased_at"
                            :value="$collectible->purchased_at">
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
                            :value="$collectible->additional_field"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.switcher
                            name="properties[is_done]"
                            value="1"
                            :checked="$collectible->properties['is_done'] ?? false"
                            :label="__('game.is_done')">
                        </x-ui.form.switcher>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.switcher
                            name="properties[is_digital]"
                            value="1"
                            :checked="$collectible->properties['is_digital'] ?? false"
                            :label="__('game.is_digital')">
                        </x-ui.form.switcher>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>

            <x-grid type="container">
                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('collectible.collectable', 1)"
                            id="collectable"
                            name="collectable"
                            :value="$collectible->collectable->name"
                            :disabled="true">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="5" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <div id="kit" class="admin__conditions">
                            <x-ui.star-rating
                                name="kit_score"
                                input-name="kit_score"
                                :hide-none-button="true"
                                :title="__('collectible.kit.score')"
                                :value="$collectible->kit_score"
                                class="admin__conditions-item" />

                            @foreach($collectible->kitItems as $item)
                                <x-ui.star-rating
                                    :name="$item->id"
                                    :title="$item->name"
                                    :value="$item->pivot->condition"
                                    input-name="kit_conditions[{{ $item->id }}]"
                                    class="admin__conditions-item" />
                            @endforeach
                        </div>
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
                                    :checked="$collectible->target == 'collection'"
                                    :group="true"
                                    :label="__('common.for_collection')">
                                </x-ui.form.radio-button>

                                <x-ui.form.radio-button
                                    id="radio-sale"
                                    name="target"
                                    value="sale"
                                    color="dark"
                                    :group="true"
                                    :checked="$collectible->target == 'sale'"
                                    :label="__('common.for_sale')">
                                </x-ui.form.radio-button>

                                <x-ui.form.radio-button
                                    id="radio-auction"
                                    name="target"
                                    value="auction"
                                    color="dark"
                                    :group="true"
                                    :checked="$collectible->target == 'auction'"
                                    :label="__('common.for_auction')">
                                </x-ui.form.radio-button>

                                <x-ui.form.radio-button
                                    id="radio-exchange"
                                    name="target"
                                    value="exchange"
                                    color="dark"
                                    :group="true"
                                    :checked="$collectible->target == 'exchange'"
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
                                    :value="$collectible->sale?->price->value() ?? ''"
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
                                    :value="$collectible->sale?->price_old?->value() ?? ''"
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
                                    :value="$collectible->sale->quantity ?? 0"
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
                                    :selected="$collectible->sale->reservation ?? 'none'"
                                    :label="__('collectible.reservation.choose')"/>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.switcher
                                    name="sale[bidding]"
                                    value="1"
                                    :checked="$collectible->sale?->bidding ?? false"
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
                                    :value="$collectible->auction?->price->value()"
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
                                    :value="$collectible->auction?->step->value()"
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
                                    name="auction[finished_at]"
                                    :time="true"
                                    :value="$collectible->auction?->finished_at">
                                </x-ui.form.datepicker>
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
                                    :selected="$collectible->sale?->country_id"
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
                                    :selected="$collectible->sale?->shipping"
                                    :label="__('collectible.shipping.option')"/>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                            <x-ui.form.group>
                                <div id="shipping_countries_block" style="display: none">
                                    <x-ui.select.data-multiple
                                        name="shipping_countries"
                                        select-name="shipping_countries[]"
                                        id="shipping_countries"
                                        :options="$countries"
                                        :selected="$selectedShippingCountries"
                                        :label="__('collectible.shipping.choose_countries')"
                                        :default-option="trans_choice('settings.country.countries', 2)"
                                    />
                                </div>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.switcher
                                    name="self_delivery"
                                    value="1"
                                    :checked="$collectible->sale?->self_delivery ?? false"
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

            targets.forEach( target => {
                hideTarget();

                @if(old('target') == 'sale' || $collectible->target == 'sale')
                    setTargetSale();
                @endif

                @if(old('target') == 'auction' || $collectible->target == 'auction')
                    setTargetAuction();
                @endif
            })

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
