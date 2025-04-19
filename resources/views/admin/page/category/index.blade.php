<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
            {{ __('page.category.list') }}
    </x-ui.title>

    <x-common.action-table model-name="admin.page-categories" :mass-delete="false" :selectable="false">
        <x-ui.responsive-table :empty="$pageCategories->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="id" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="name">
                    {{ trans_choice('common.name', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="parent.name">
                    {{ __('page.category.parent') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="users.name">
                    {{ trans_choice('user.users', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($pageCategories as $item)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="id">
                        {{ $item->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.name', 1) }}: </span> {{ $item->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('page.category.parent') }}: </span> {{ $item->parent?->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('user.users', 1) }}: </span> {{ $item->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $item->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$item" model="admin.page-categories" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>
    </x-common.action-table>

    {{ $pageCategories->links('pagination::default') }}

</x-layouts.admin>
