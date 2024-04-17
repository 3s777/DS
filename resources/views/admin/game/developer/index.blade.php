<x-layouts.admin>
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('game.developer.list') }}
        @endif
    </x-ui.title>

    @include('admin.game.developer.partials.filters')

    <x-common.action-table>
        <x-ui.responsive-table class="responsive-table_crud">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column name="check">


                    <x-common.action-table.select-all :models="$developers">

                    </x-common.action-table.select-all>


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
                        <x-common.action-table.row-checkbox :model="$developer" />
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
                        <x-common.action-table.buttons :item="$developer" model="game-developers" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach

            <x-slot:footer>
                <div x-data="{ actionSelect: ''}" class="responsive-table__action">
                    <x-libraries.choices
                        x-model="actionSelect"
                        class="responsive-table__select-action"
                        size="small"
                        id="responsive-table__select-action"
                        name="responsive-table__select-action"
                        label="Действие с отмеченными">
                        <x-ui.form.option>Выберите действие</x-ui.form.option>
                        <x-ui.form.option value="delete">Удалить</x-ui.form.option>
                        <x-ui.form.option value="forceDelete">Удалить навсегда</x-ui.form.option>
                    </x-libraries.choices>


                    <div x-show="!actionSelect || actionSelect.value === ''" x-on:keydown.escape.window="$store.modalMassDelete.hide = true">
                        <x-ui.form.button
                            tag="div"
                            x-on:click.stop="prepareDeleteModal(actionSelect)"
                        >Примеnнить</x-ui.form.button>
                    </div>

                    <template x-if="actionSelect.value === 'delete' || actionSelect.value === 'forceDelete'">
                        <div x-on:keydown.escape.window="$store.modalMassDelete.hide = true">
                            <x-ui.form.button
                                tag="div"
                                x-on:click.stop="prepareDeleteModal(actionSelect)"
                            >Тульк</x-ui.form.button>
                        </div>
                    </template>


                </div>
            </x-slot:footer>

        </x-ui.responsive-table>
    </x-common.action-table>

    @if($developers->isEmpty())
        <x-common.missing>
            {{ __('common.not_found') }}
        </x-common.missing>
    @endif

    {{ $developers->links('pagination::default') }}

    <x-common.action-table.modal-delete />
    <x-common.action-table.modal-mass-delete />
</x-layouts.admin>

@push('scripts')
    <script>

    </script>
@endpush
