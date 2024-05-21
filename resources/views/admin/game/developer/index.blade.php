<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('crud.list', ['entity' => __('entity.game_developer_b')]) }}
        @endif
    </x-ui.title>

    @include('admin.game.developer.partials.filters')

    <x-common.action-table model-name="game-developers">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => __('common.name'),
                'users.name' => __('common.user'),
                'created_at' => __('common.created_date'),
            ]" />

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

    {{ $developers->links('pagination::default') }}

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
    @endpush
</x-layouts.admin>

