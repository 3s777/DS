<x-layouts.admin>
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('game.developer.list') }}
        @endif
    </x-ui.title>

    @include('admin.game.developer.partials.filters')

    <div class="form-group" x-data="{ sort: '{{ filter_url(['sort' => request('sort'), 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}'}">
        <x-libraries.choices
            id="" x-model="sort"
            x-on:change="window.location = sort.value"
{{--x-on:change="console.log(sort.value)"--}}
            class="sort-select"
            id="select-test"
            name="select-test"
            label="Сортировка">
            <x-ui.form.option value="">Сортировать по:</x-ui.form.option>
            <option
                value="{{ filter_url(['sort' => 'id', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">id</option>
            <option
                value="{{ filter_url(['sort' => 'name', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">Название</option>
            <option
                value="{{ filter_url(['sort' => 'users.name', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">Пользователь</option>
            <option
                value="{{ filter_url(['sort' => 'created_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">Добавлен</option>
        </x-libraries.choices>

    </div>

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
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$developer" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $developer->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.name') }}: </span> {{ $developer->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.user') }}: </span> {{ $developer->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $developer->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$developer" model="game-developers" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

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
    </x-common.action-table>


    {{ $developers->links('pagination::default') }}

    @push('scripts')
        <script type="module">
            const element1 = document.querySelector('.sort-select');
            const choices1 = new Choices(element1, {
                itemSelectText: '',
                searchEnabled: false,
                noResultsText: '{{ __('Не найдено') }}',
                noChoicesText: '{{ __('Больше ничего нет') }}',
            });
        </script>
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



