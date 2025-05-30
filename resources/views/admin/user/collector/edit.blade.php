<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('admin.collectors.update', $collector->slug)"
        :title="__('user.collector.edit')"
        :model="$collector">
            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__('auth.username')"
                            id="name"
                            name="name"
                            :value="$collector->name"
                            required
                            autocomplete="on"
                            autofocus>
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__('auth.first_name')"
                            id="first_name"
                            name="first_name"
                            :value="$collector->first_name"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__('common.slug')"
                            id="slug"
                            name="slug"
                            :value="$collector->slug"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.enum
                            name="language"
                            select-name="language"
                            :options="$languages"
                            :label="__('common.language')"
                            :selected="$collector->language"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            type="email"
                            :placeholder="__('common.email')"
                            id="email"
                            name="email"
                            required
                            :value="$collector->email"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__('auth.password')"
                            id="password"
                            :show-old="false"
                            name="password">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.switcher
                            name="is_verified"
                            :value="1"
                            :label="__('auth.is_verified')"
                            :checked="$collector->email_verified_at">
                        </x-ui.form.switcher>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple
                            name="roles"
                            select-name="roles[]"
                            type="input"
                            :selected="$selectedRoles"
                            :options="$roles"
                            :label="trans_choice('user.role.choose', 1)"/>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>

            <x-ui.form.group>
                <x-ui.accordion>
                    <x-ui.accordion.item  padding="none" color="light">
                        <x-ui.accordion.title>{{ __('user.permission.additional') }}</x-ui.accordion.title>
                        <x-ui.accordion.content>
                            <x-grid type="container">
                                @foreach($permissions as $key => $permission)
                                    <x-grid.col xl="3" ls="6" ml="12" lg="6" md="6" sm="12">
                                        <x-ui.form.group size="small">
                                            <x-ui.form.input-checkbox
                                                id="permission-{{ $key }}"
                                                name="permissions[]"
                                                :value="$permission['name']"
                                                :label="$permission['display_name']"
                                                :disabled="in_array($permission['name'], $rolePermissions)"
                                                :checked="old()
                                                    ? in_array($permission['name'], old('permissions', []))
                                                    : $collector->hasPermissionTo($permission['name'])">
                                            </x-ui.form.input-checkbox>
                                        </x-ui.form.group>
                                    </x-grid.col>
                                @endforeach
                            </x-grid>
                        </x-ui.accordion.content>
                    </x-ui.accordion.item>
                </x-ui.accordion>
            </x-ui.form.group>
        <x-slot:sidebar></x-slot:sidebar>
    </x-admin.crud-form>
</x-layouts.admin>
