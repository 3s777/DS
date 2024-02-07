<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
        <x-common.content class="admin" wrapper-class="admin__content">
            <x-slot:sidebar>
                <x-common.sidebar-menu class="admin__menu" />
            </x-slot:sidebar>

            <x-ui.title size="normal" indent="big">{{ __('game.developer.list') }}</x-ui.title>

            <x-common.messages />

            <form action="{{ route('game-developers.index') }}"
                  method="get">

                <input name="sort" type="hidden" value="{{ request()->get('sort') }}">
                <input name="order" type="hidden" value="{{ request()->get('sort') == 'asc' ? 'desc' : 'asc' }}">
                @foreach(filters() as $filter)
                    {!! $filter !!}
                @endforeach
                <button>Найти</button>
            </form>

            <div class="responsive-table">
                <div>
                </div>
                <div class="responsive-table__header">
                    <div class="responsive-table__column responsive-table__column_id">
                        {{ __('Id') }}
                    </div>
                    <div class="responsive-table__column">
                        <div class="responsive-table__sortable">
                            {{ __('Name') }}


                                <a href="{{ filter_url(['sort' => 'name', 'order' => 'asc']) }}">
                                    <div class="responsive-table__arrow"></div>
                                </a>

                        </div>

                    </div>
                    <div class="responsive-table__column">
                        {{ __('Slug') }}
                    </div>
                    <div class="responsive-table__column responsive-table__column_action">
                        {{ __('Action') }}
                    </div>
                </div>
                @foreach($developers as $developer)
                <div class="responsive-table__row">
                    <div class="responsive-table__column responsive-table__column_id">
                        {{ $developer->id }}
                    </div>
                    <div class="responsive-table__column">
                        {{ $developer->name }}
                    </div>
                    <div class="responsive-table__column">
                        {{ $developer->slug }}
                    </div>
                    <div class="responsive-table__column responsive-table__column_action">
                        <div class="responsive-table__buttons">
                            <x-ui.form.button
                                tag="a"
                                link="{{ route('game-developers.edit', $developer->slug) }}"
                                color="warning"
                                only-icon="true"
                                size="small"
                                title="{{ __('common.edit') }}">
                                <x-slot:icon class="button__icon-wrapper_edit">
                                    <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                                </x-slot:icon>
                            </x-ui.form.button>

                            <div x-data x-on:keydown.escape.window="$store.modal.hide = true">
                                <div x-on:click.stop="
                                    $store.modal.hide = ! $store.modal.hide;
                                    $store.modal.action = '{{ route('game-developers.destroy', $developer->slug) }}'
                                    $store.modal.name = '{{  $developer->name }}'
                                    ">
                                    <x-ui.form.button
                                        color="cancel"
                                        only-icon="true"
                                        size="small"
                                        title="{{ __('common.delete') }}">
                                        <x-slot:icon class="button__icon-wrapper_cancel">
                                            <x-svg.close class="button__icon button__icon_small"></x-svg.close>
                                        </x-slot:icon>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{ $developers->links('pagination::default') }}

            <x-ui.modal x-data tag="section"  ::class="$store.modal.hide ? '' : 'modal_show'">
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

        </x-common.content>
    </x-grid.container>

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
</x-layouts.main>
