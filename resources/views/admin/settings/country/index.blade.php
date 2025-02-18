<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
            {{ __('settings.country.list') }}
    </x-ui.title>

    <x-common.action-table model-name="admin.countries" :mass-delete="false" :selectable="false">
        <x-ui.responsive-table :empty="$countries->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$countries" />
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

            @foreach($countries as $item)
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
                        <x-common.action-table.buttons :item="$item" model="admin.countries" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action />
        </x-slot:footer>
    </x-common.action-table>

</x-layouts.admin>
