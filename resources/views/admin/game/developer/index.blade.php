<x-layouts.admin>
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('game.developer.list') }}
        @endif
    </x-ui.title>

    @include('admin.game.developer.partials.filters')

    <x-ui.responsive-table class="responsive-table_crud">
        <x-ui.responsive-table.header>
            <x-ui.responsive-table.column name="check">

            </x-ui.responsive-table.column>
            <x-ui.responsive-table.column type="id" sortable="true" name="id">
                {{ __('common.id') }}
            </x-ui.responsive-table.column>
            <x-ui.responsive-table.column sortable="true" name="name">
                {{ __('common.name') }}
            </x-ui.responsive-table.column>
            <x-ui.responsive-table.column name="slug">
                {{ __('common.slug') }}
            </x-ui.responsive-table.column>
            <x-ui.responsive-table.column name="created_at" sortable="true">
                {{ __('common.created_date') }}
            </x-ui.responsive-table.column>
            <x-ui.responsive-table.column type="action" name="action">
                {{ __('common.action') }}
            </x-ui.responsive-table.column>
        </x-ui.responsive-table.header>

        @foreach($developers as $developer)
            <x-ui.responsive-table.row >
                <x-ui.responsive-table.column>
                    <x-ui.form.input-checkbox
                        x-data="{id:'{{ $developer->id }}', name: '{{ $developer->name }}'}"
                        @change="selectRow"
                        id="selected_row_{{ $developer->id }}"
                        name="selected_row_{{ $developer->id }}"
                    >
                    </x-ui.form.input-checkbox>
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id">
                    {{ $developer->id }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column>
                    {{ $developer->name }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column>
                    {{ $developer->slug }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column>
                    {{ $developer->created_at }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action">
                    <x-ui.responsive-table.buttons :item="$developer" model="game-developers" />
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.row>
        @endforeach
    </x-ui.responsive-table>


    @if($developers->isEmpty())
        <x-common.missing>
            {{ __('common.not_found') }}
        </x-common.missing>
    @endif

    {{ $developers->links('pagination::default') }}

    <x-ui.responsive-table.modal-delete />
</x-layouts.admin>
