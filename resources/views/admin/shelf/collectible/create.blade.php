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
                            :value="old('name')"
                            required
                            autocomplete="on"
                            autofocus>
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('common.article_numbers', 1)"
                            id="number"
                            name="number"
                            :value="old('number')"
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
                        <x-ui.select.async-multiple
                            name="user_m"
                            select-name="user_idm[m]"
                            route="select-users"
                            :selected="$users"
                            :required="true"
                            :default-option="trans_choice('user.choose', 1)"
                            :label="trans_choice('user.users', 1)">
                        </x-ui.select.async-multiple>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="user"
                            select-name="user_id"
                            :required="true"
                            route="select-users"
                            :default-option="trans_choice('user.choose', 1)"
                            :label="trans_choice('user.users', 1)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
{{--                        <x-ui.select.async-depend--}}
{{--                            name="shelf"--}}
{{--                            required--}}
{{--                            route="select-shelves"--}}
{{--                            depend-on="user"--}}
{{--                            depend-field="user_id"--}}
{{--                            :default-option="trans_choice('shelf.choose', 1)"--}}
{{--                            :label="trans_choice('shelf.shelves', 1)" />--}}
                        <x-ui.select.async-multiple-depend
                            name="shelf"
                            route="select-shelves"
                            depend-on="user_id"
                            depend-field="user_id"
                            select-name="shelf_id"
                            :default-option="trans_choice('shelf.choose', 1)"
                            :label="trans_choice('shelf.shelves', 1)">
                        </x-ui.select.async-multiple-depend>
                    </x-ui.form.group>
                </x-grid.col>


                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="user1"
                            select-name="user1_id"
                            required
                            route="select-users"
{{--                            :selected="auth()->user()"--}}
                            :default-option="trans_choice('user.choose', 1)"
                            :label="trans_choice('user.users', 1)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-depend
                            name="shelf1"
                            select-name="shelf1_id"
                            required
                            route="select-shelves"
                            depend-on="user1_id"
                            depend-field="user_id"
{{--                            selected="12"--}}
                            :default-option="trans_choice('shelf.choose', 1)"
                            :placeholder="trans_choice('shelf.shelves', 1)" />
                    </x-ui.form.group>
                </x-grid.col>


                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="user2"
                            select-name="user2_id"
                            required
                            route="select-users"
                            :selected="[auth()->user()->id => auth()->user()->name]"
                            :default-option="trans_choice('user.choose', 1)"
                            :label="trans_choice('user.users', 1)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple-depend
                            name="shelf2"
                            select-name="shelf2_id[]"
                            required
                            route="select-shelves"
                            depend-on="user2_id"
                            depend-field="user_id"
                            :selected="[12,13]"
                            :default-option="trans_choice('shelf.choose', 1)"
                            :placeholder="trans_choice('shelf.shelves', 1)" />
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

        @dump(old())

        @dump($errors)

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

{{--    <select name="" id="yy">--}}
{{--        <option value="s">1</option>--}}
{{--        <option value="vs">1x</option>--}}
{{--        <option value="vsv">1v</option>--}}
{{--    </select>--}}
{{--    @push('scripts')--}}
{{--    <script type="module">--}}
{{--        const element = document.getElementById('yy');--}}
{{--        const example = new Choices(element);--}}

{{--        element.addEventListener(--}}
{{--            'addItem',--}}
{{--            function(event) {--}}
{{--                // do something creative here...--}}
{{--                console.log(event.detail.id);--}}
{{--                console.log(event.detail.value);--}}
{{--                console.log(event.detail.label);--}}
{{--                console.log(event.detail.customProperties);--}}
{{--                console.log(event.detail.groupValue);--}}
{{--            },--}}
{{--            false,--}}
{{--        );--}}
{{--    </script>--}}
{{--    @endpush--}}
</x-layouts.admin>


