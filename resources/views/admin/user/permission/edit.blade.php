<x-layouts.admin :search="false">
    <x-ui.form class="crud-form crud-form_full-width"
               method="put"
               id="edit-form"
               :action="route('permissions.update', $permission->id)"
               enctype="multipart/form-data">
            <x-ui.title class="crud-form__tile" size="normal" indent="small">
                {{ __('permission.edit') }}
            </x-ui.title>

            <div class="crud-form__main">
                <x-grid type="container">
                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :placeholder="trans_choice('common.name', 1)"
                                id="name"
                                name="name"
                                :value="$permission->name"
                                required
                                autocomplete="on"
                                autofocus>
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :placeholder="__('common.display_name')"
                                id="display_name"
                                name="display_name"
                                :value="$permission->display_name"
                                required
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>
            </div>

            <div class="crud-form__description">
                <x-ui.form.group>
                    <x-libraries.rich-text-editor
                        name="description"
                        :value="$permission->description"
                        :placeholder="__('common.description')"/>
                </x-ui.form.group>
            </div>

            <x-ui.form.group class="crud-form__submit">
                <x-ui.form.button
                    class="crud-form__submit-button"
                    x-bind:disabled="preventSubmit">
                    {{ __('common.save') }}
                </x-ui.form.button>
            </x-ui.form.group>
        </x-ui.form>
</x-layouts.admin>
