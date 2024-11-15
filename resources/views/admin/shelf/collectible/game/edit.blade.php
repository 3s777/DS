<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               method="put"
               id="edit-form"
               :action="route('collectibles.update.game', $collectible->id)"
               enctype="multipart/form-data">
        <x-ui.title class="crud-form__tile" size="normal" indent="small">
            {{ __('collectible.edit') }}
        </x-ui.title>

        <div class="crud-form__main">
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
                            name="user_id"
                            select-name="user_id"
                            route="select-users"
                            :required="true"
                            :selected="$selectedUser"
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
                            :selected="$collectible->shelf->id"
                            route="shelves.select"
                            depend-on="user_id"
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
                            :value="$collectible->purchase_price"
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
                            @foreach($collectible->kitItems as $item)
                                <x-ui.star-rating
                                    :name="$item->id"
                                    :title="$item->name"
                                    :value="$item->collectible->condition"
                                    input-name="kit_conditions[{{ $item->id }}]"
                                    class="admin__conditions-item" />
                            @endforeach


                            @foreach($collectible->collectable->kitItems as $item)
                                <x-ui.star-rating
                                    :name="$item->id"
                                    :title="$item->name"
                                    :value="$collectible->kit_conditions[$item->id]"
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
                                    placeholder="{{ __('collectible.sale_price') }} *"
                                    id="sale_price"
                                    name="sale[price]"
                                    step="0.01"
                                    :value="$collectible->sale['price'] ?? ''"
                                    type="number"
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    placeholder="{{ __('collectible.sale_price_old') }} *"
                                    id="sale_price_old"
                                    name="sale[price_old]"
                                    step="0.01"
                                    :value="$collectible->sale['price_old'] ?? ''"
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
                                    :value="$collectible->auction['price'] ?? ''"
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
                                    :value="$collectible->auction['step'] ?? ''"
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
                                    :value="$collectible->auction['to'] ?? ''">
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
                    :value="$collectible->description"
                    :placeholder="__('common.description')"/>
            </x-ui.form.group>
        </div>

        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                <x-ui.form.input-image
                    class="crud-form__input-image"
                    name="thumbnail"
                    id="thumbnail"
                    :path="$collectible->getThumbnailPath()">
                    @if($collectible->getThumbnailPath())
                    <x-slot:uploaded-thumbnail>
                        <x-ui.responsive-image
                            :model="$collectible"
                            :image-sizes="['small', 'medium', 'large']"
                            :path="$collectible->getThumbnailPath()"
                            :placeholder="false"
                            sizes="(max-width: 1024px) 100vw, (max-width: 1400px) 30vw, 220px">
                            <x-slot:img alt="test" title="test title"></x-slot:img>
                        </x-ui.responsive-image>
                    </x-slot:uploaded-thumbnail>
                    @endif
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
        </script>
    @endpush
</x-layouts.admin>
