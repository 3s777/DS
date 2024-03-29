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

            @forelse($developers as $developer)
                <x-ui.responsive-table.row>
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
        @empty
                <div>Ничего не найдено</div>
            @endforelse
        </x-ui.responsive-table>

        {{ $developers->links('pagination::default') }}

        <x-ui.responsive-table.modal-delete />

</x-layouts.admin>
