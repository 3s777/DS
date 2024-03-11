<x-layouts.admin title="{{ __('game.developer.list') }}">

<x-admin.crud-filters>
    <x-admin.crud-filters-form>
        <x-grid.col xl="3" lg="4"  md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates />
            </x-ui.form.group>
        </x-grid.col>
        <x-grid.col xl="3" lg="4"  md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates direction="to" />
            </x-ui.form.group>
        </x-grid.col>
        {{--@foreach(filters() as $filter)--}}
        {{--{!! $filter !!}--}}
        {{--@endforeach--}}
        <x-slot:buttons></x-slot:buttons>

    </x-admin.crud-filters-form>
</x-admin.crud-filters>

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
                    {{ __('common.created-date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($developers as $developer)
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

        @endforeach
        </x-ui.responsive-table>

        {{ $developers->links('pagination::default') }}

        <x-ui.modal x-data tag="section" ::class="$store.modal.hide ? '' : 'modal_show'">
            <x-ui.modal.content
                x-on:click.outside="$store.modal.hide = true">
                <x-ui.modal.close x-on:click="$store.modal.hide = true" />

                <x-ui.modal.header>
                    <x-ui.title
                        size="normal"
                        indent="normal">
                        {{ __('common.deleting') }}
                    </x-ui.title>
                </x-ui.modal.header>

                <x-ui.modal.body>
                    {{ __('common.delete-confirmation') }} <span x-text="$store.modal.name"></span>?
                </x-ui.modal.body>

                <x-ui.modal.footer align-buttons="right">
                    <x-ui.form method="delete" x-bind:action=$store.modal.action>
                        <x-ui.form.button x-bind:disabled="preventSubmit">
                            {{ __('common.delete') }}
                        </x-ui.form.button>

                        <x-ui.form.button
                            x-on:click.prevent="$store.modal.hide = true"
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
                Alpine.store('modal', {
                    hide: true,
                    action: false,
                    name: false
                });
            })
        </script>
    @endpush

</x-layouts.admin>
