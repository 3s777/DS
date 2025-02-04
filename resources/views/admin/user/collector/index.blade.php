<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('user.collector.list') }}
        @endif
    </x-ui.title>

    @include('admin.user.collector.partials.filters')

    <x-common.action-table model-name="admin.collectors">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => __('auth.username'),
                'first_name' => __('auth.first_name'),
                'email' => __('common.email'),
                'created_at' => __('common.created_date'),
            ]"/>

        <x-ui.responsive-table :empty="$collectors->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$collectors"/>
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" sortable="true" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="name">
                    {{ __('auth.username') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="first_name">
                    {{ __('auth.first_name') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="email">
                    {{ __('common.email') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at" sortable="true">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($collectors as $collector)
                <x-ui.responsive-table.row>
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$collector"/>
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $collector->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('auth.username') }}: </span> {{ $collector->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span
                            class="responsive-table__label">{{ __('auth.first_name') }}: </span> {{ $collector->first_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.email') }}: </span> {{ $collector->email }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span
                            class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $collector->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$collector" :show="true" model="admin.collectors"/>
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action>

            </x-common.action-table.selected-action>
        </x-slot:footer>
    </x-common.action-table>

    {{ $collectors->links('pagination::default') }}

</x-layouts.admin>
