<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('game.list') }}
        @endif
    </x-ui.title>

    @include('admin.game.partials.filters')

    <x-common.action-table model-name="games">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => __('common.name'),
                'users.name' => __('user.user'),
                'created_at' => __('common.created_date'),
            ]" />

        <x-ui.responsive-table :empty="$games->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$games" />
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" sortable="true" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="name">
                    {{ __('common.name') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="genre">
                    {{ __('game_genre.genre') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="platform">
                    {{ __('game_platform.platform') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="users.name" sortable="true">
                    {{ __('user.user') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at" sortable="true">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($games as $game)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$game" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $game->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.name') }}: </span> {{ $game->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('game_genres.genre') }}: </span>
                        @foreach($game->genres as $genre)
                            {{ $genre['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('game_platforms.platform') }}: </span>
                        @foreach($game->platforms as $platform)
                            {{ $platform['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('user.user') }}: </span> {{ $game->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $game->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$game" model="games" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action>
                <x-ui.form.option value="test1">Тестируем выбор</x-ui.form.option>
                <x-slot:action>
                    <template x-if="actionSelect.value === 'test1'">
                        <div class="action-table__select-button" x-on:keydown.escape.window="$store.modalTest.hide = true">
                            <x-ui.form.button
                                tag="div"
                            x-on:click.stop="$store.modalTest.hide = ! $store.modalTest.hide;"
                            >Тестируем кнопку</x-ui.form.button>
                        </div>
                    </template>
                </x-slot:action>
            </x-common.action-table.selected-action>
        </x-slot:footer>
    </x-common.action-table>

    {{ $games->links('pagination::default') }}

    <x-ui.modal x-data tag="section" ::class="$store.modalTest.hide ? '' : 'modal_show'">
        <x-ui.modal.content
            x-on:click.outside="$store.modalTest.hide = true">
            <x-ui.modal.close x-on:click="$store.modalTest.hide = true" />

            <x-ui.modal.header>
                <x-ui.title
                    size="normal"
                    indent="normal">
                    Modal test
                </x-ui.title>
            </x-ui.modal.header>

            <x-ui.modal.body>
                Modal test content
            </x-ui.modal.body>

            <x-ui.modal.footer align-buttons="right">
                <x-ui.form method="delete" x-bind:action=$store.modalTest.action>
                    <x-ui.form.button
                        x-on:click.prevent="$store.modalTest.hide = true"
                        color="cancel"
                        indent="left">
                        {{ __('common.close') }}
                    </x-ui.form.button>
                </x-ui.form>
            </x-ui.modal.footer>
        </x-ui.modal.content>
    </x-ui.modal>

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
        <script type="module">
            const genres = document.querySelector('.choices-genres');
            const choicesGenres = new Choices(genres, {
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                noResultsText: '{{ __('common.not_found') }}',
                noChoicesText: '{{ __('common.nothing_else') }}',
            });
        </script>
    @endpush
</x-layouts.admin>

