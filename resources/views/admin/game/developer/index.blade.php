<x-layouts.admin>
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('game.developer.list') }}
        @endif
    </x-ui.title>

    @include('admin.game.developer.partials.filters')



    <x-common.action-table model-name="game-developers">
        <x-ui.responsive-table :data="$developers->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$developers" />
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" sortable="true" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="name">
                    {{ __('common.name') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="users.name" sortable="true">
                    {{ __('common.user') }}
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
                        <x-common.action-table.row-checkbox :model="$developer" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $developer->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        {{ $developer->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        {{ $developer->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        {{ $developer->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$developer" model="game-developers" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach

            <x-slot:footer>
                <x-common.action-table.selected-action>
                    <x-ui.form.option value="test1">Тестируем выбор</x-ui.form.option>
                    <x-slot:action>
                        <template x-if="actionSelect.value === 'test1'">
                            <div x-on:keydown.escape.window="$store.modalTest.hide = true">
                                <x-ui.form.button
                                    tag="div"
                                    x-on:click.stop="$store.modalTest.test(actionSelect.value)"
                                >Тестируем кнопку</x-ui.form.button>
                            </div>
                        </template>
                    </x-slot:action>
                </x-common.action-table.selected-action>
            </x-slot:footer>

        </x-ui.responsive-table>
    </x-common.action-table>

    {{ $developers->links('pagination::default') }}

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('modalTest', {
                    hide: true,
                    test(actionSelect) {
                        console.log(actionSelect);
                    }
                });
            });
        </script>
    @endpush
</x-layouts.admin>



