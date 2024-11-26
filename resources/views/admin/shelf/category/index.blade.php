<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
            {{ __('collectible.category.list') }}
    </x-ui.title>

    <x-common.action-table model-name="categories">
        <x-ui.responsive-table :empty="$categories->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$categories" />
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="name">
                    {{ trans_choice('common.name', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($categories as $item)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$item" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $item->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.name', 1) }}: </span> {{ $item->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $item->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$item" model="categories" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action />
        </x-slot:footer>
    </x-common.action-table>

    {{ $categories->links('pagination::default') }}

</x-layouts.admin>
