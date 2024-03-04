<x-layouts.admin title="{{ __('game.developer.list') }}">

    <div class="crud-filters" x-data="{ filters_hide: true, search: '{{ request('filters.search') }}' }">
        <div class="crud-filters__header">
            <x-ui.input-search
                x-model="search"
                class="crud-search__form"
                wrapper-class="crud-search"
                action="{!! route('game-developers.index') !!}"
                method="get"
                placeholder="{{ __('game.developer.search') }}"
                color="dark"
                sortable="true"
            />

            <x-ui.form.button
                class="crud-filters__trigger"
                only-icon="true"
                size="small"
                color="dark"
                ::class="filters_hide ? '' : 'button_submit'"
                x-on:click="filters_hide = !filters_hide">
                <x-slot:icon class="button__icon-wrapper_filter">
                    <x-svg.filter class="button__icon button__icon_small"></x-svg.filter>
                </x-slot:icon>
            </x-ui.form.button>
        </div>

        <div class="crud-filters__content" x-cloak x-show="!filters_hide" x-transition.scale.right>
            <form action="{!! route('game-developers.index') !!}" method="get">

                <x-grid type="container">
                    @foreach(filters() as $filter)
                        {!! $filter !!}
                    @endforeach
                    <x-grid.col xl="12" lg="12"  md="12" sm="12">
                        <x-ui.form.group>
                            <div class="main-search__footer">
                                <x-ui.form.button>{{ __('common.filter') }}</x-ui.form.button>
                                <x-ui.form.button tag="a" link="{{ request()->url() }}" color="warning">{{ __('common.reset') }}</x-ui.form.button>
                                <x-ui.form.button color="cancel"  x-on:click.prevent="filters_hide = true">{{ __('common.close') }}</x-ui.form.button>
                            </div>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>
            </form>
        </div>



        @if(request('filters'))
            <div class="crud-filters__footer">
                <div class="current-filters">
                    @foreach(filters() as $filter)



                        @if($filter->preparedValues())
                            @if($loop->first)
                                <div class="current-filters__title">{{ __('filters.badges-title') }}: </div>
                            @endif


                            {!! $filter->badgeView() !!}

                            @if($loop->last)
                                <x-ui.badge
                                    class="current-filters__badge"
                                    type="tag"
                                    color="danger">
                                    <a href="{{ request()->url() }}">
                                        {{ __('filters.reset-all') }}
                                    </a>
                                </x-ui.badge>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>

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
