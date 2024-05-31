<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
            {{ __('model/role.list') }}
    </x-ui.title>

    <x-common.action-table model-name="roles" :mass-delete="false" :selectable="false">
        <x-ui.responsive-table :data="$roles->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="id" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="name">
                    {{ __('common.name') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="first_name">
                    {{ __('common.display_name') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($roles as $role)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="id">
                        {{ $role->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.name') }}: </span> {{ $role->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.display_name') }}: </span> {{ $role->display_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $role->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$role" model="roles" :slug="false" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>
    </x-common.action-table>

    {{ $roles->links('pagination::default') }}

</x-layouts.admin>
