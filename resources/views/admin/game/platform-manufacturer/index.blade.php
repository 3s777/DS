<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        {{ __('game_platform_manufacturer.list') }}
    </x-ui.title>

    <x-common.action-table model-name="game-platform-manufacturers">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => __('common.name'),
                'users.name' => __('common.user'),
                'created_at' => __('common.created_date'),
            ]" />

        <x-ui.responsive-table :empty="$manufacturers->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$manufacturers" />
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="name">
                    {{ __('common.name') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="users.name">
                    {{ __('common.user') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($manufacturers as $manufacturer)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$manufacturer" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $manufacturer->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.name') }}: </span> {{ $manufacturer->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.user') }}: </span> {{ $manufacturer->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $manufacturer->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$manufacturer" model="game-platform-manufacturers" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
        </x-slot:footer>
    </x-common.action-table>

    {{ $manufacturers->links('pagination::default') }}

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

