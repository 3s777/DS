<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('admin.roles.update', $role->id)"
        :title="__('user.role.edit')"
        :model="$role">
                <x-grid type="container">
                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :placeholder="trans_choice('common.name', 1)"
                                id="name"
                                name="name"
                                :value="$role->name"
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
                                required
                                :value="$role->display_name"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.select.data
                                name="guard_name"
                                select-name="guard_name"
                                required
                                :selected="$role->guard_name"
                                :options="[
                                'admin' => trans_choice('user.admins', 1),
                                'collector' => trans_choice('user.collectors', 1)
                            ]"
                                :default-option="__('user.type')"
                                :label="__('user.choose_type')" />
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>

                    @if($role->guard_name === 'admin')
                        <div class="crud-form__block">
                            <x-ui.title indent="normal">{{ __('user.permission.admin') }}</x-ui.title>
                            <x-grid type="container">
                                @foreach($permissionsAdmin as $key => $permission)
                                    <x-grid.col xl="3" ls="6" ml="12" lg="6" md="6" sm="12">
                                        <x-ui.form.group size="small">
                                            <x-ui.form.input-checkbox
                                                id="permission-{{ $key }}"
                                                name="permissions_admin[]"
                                                :value="$permission['name']"
                                                :label="$permission['display_name']"
                                                :checked="old()
                                                    ? in_array($permission['name'], old('permissions', []))
                                                    : $role->hasPermissionTo($permission['name'])">
                                            </x-ui.form.input-checkbox>
                                        </x-ui.form.group>
                                    </x-grid.col>
                                @endforeach
                            </x-grid>
                        </div>
                    @endif

                    @if($role->guard_name === 'collector')
                        <div class="crud-form__block">
                            <x-ui.title indent="normal">{{ __('user.permission.collector') }}</x-ui.title>
                            <x-grid type="container">
                                @foreach($permissionsCollector as $key => $permission)
                                    <x-grid.col xl="3" ls="6" ml="12" lg="6" md="6" sm="12">
                                        <x-ui.form.group size="small">
                                            <x-ui.form.input-checkbox
                                                id="permission-{{ $key }}"
                                                name="permissions_collector[]"
                                                :value="$permission['name']"
                                                :label="$permission['display_name']"
                                                :checked="old()
                                                ? in_array($permission['name'], old('permissions', []))
                                                : $role->hasPermissionTo($permission['name'])">
                                            </x-ui.form.input-checkbox>
                                        </x-ui.form.group>
                                    </x-grid.col>
                                @endforeach
                            </x-grid>
                        </div>
                    @endif

    </x-admin.crud-form>
</x-layouts.admin>
