<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
            {{ __('permission.list') }}
    </x-ui.title>

    <x-common.action-table model-name="permissions" :mass-delete="false" :selectable="false">
        <x-ui.responsive-table :empty="$permissions->isEmpty()">
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

            @foreach($permissions as $permission)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="id">
                        {{ $permission->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.name', 1) }}: </span> {{ $permission->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.display_name') }}: </span> {{ $permission->display_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $permission->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$permission" model="admin.permissions" :slug="false" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>
    </x-common.action-table>

    {{ $permissions->links('pagination::default') }}

</x-layouts.admin>
