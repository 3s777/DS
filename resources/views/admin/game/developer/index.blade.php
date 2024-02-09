<x-layouts.admin title="{{ __('game.developer.list') }}"
>

{{--            <form action="{{ route('game-developers.index') }}"--}}
{{--                  method="get">--}}
{{--                @foreach(filters() as $filter)--}}
{{--                    {!! $filter !!}--}}
{{--                @endforeach--}}
{{--                <button>Найти</button>--}}
{{--            </form>--}}

        <x-ui.input-search
            class="crud-search__form"
            wrapper-class="crud-search"
            action="{!! route('game-developers.index') !!}"
            method="get"
            placeholder="{{ __('game.developer.search') }}"
            color="dark"
            sortable="true" />

        <x-ui.responsive-table class="responsive-table_crud">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="id" sortable="true" name="id">
                    {{ __('Id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="name">
                    {{ __('Name') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="slug">
                    {{ __('Slug') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at" sortable="true">
                    {{ __('Created Date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('Action') }}
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
