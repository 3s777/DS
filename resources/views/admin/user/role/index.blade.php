<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
            {{ __('user.role.list') }}
    </x-ui.title>

    <x-common.action-table model-name="roles" :mass-delete="false" :selectable="false">
        <x-ui.responsive-table :empty="$roles->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="id" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="name">
                    {{ trans_choice('common.name', 1) }}
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
                        <span class="responsive-table__label">{{ trans_choice('common.name', 1) }}: </span> {{ $role->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.display_name') }}: </span> {{ $role->display_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $role->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$role" model="admin.roles" :admin="false" :slug="false" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>
    </x-common.action-table>

    {{ $roles->links('pagination::default') }}

</x-layouts.admin>
