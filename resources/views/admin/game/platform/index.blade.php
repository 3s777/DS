<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        {{ __('game_platform.list') }}
    </x-ui.title>

    <x-common.action-table model-name="game-platforms">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => __('common.name'),
                'users.name' => __('user.user'),
                'created_at' => __('common.created_date'),
            ]" />

        <x-ui.responsive-table :empty="$platforms->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$platforms" />
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="name">
                    {{ __('common.name') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="type">
                    {{ __('game_platform.type') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="manufacturer">
                    {{ __('game_platform_manufacturer.manufacturer') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="users.name">
                    {{ __('user.user') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>


            @foreach($platforms as $platform)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$platform" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $platform->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.name') }}: </span> {{ $platform->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('game_platform.type') }}: </span>
                        @if($platform->type)
                            {{ $getTypeName($platform->type) }}
                        @endif
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('game_platform_manufacturer.manufacturer') }}: </span>

                            {{ $platform->manufacturer_name }}

                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('user.user') }}: </span> {{ $platform->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $platform->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$platform" model="game-platforms" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
        </x-slot:footer>
    </x-common.action-table>

    {{ $platforms->links('pagination::default') }}

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

