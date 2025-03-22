@props([
    'model',
    'routePrefix',
    'size' => 'small',
    'color' => 'dark',
    'title' => $model->name,
    'edit' => true,
    'delete' => true,
    'slug' => true
])


<div class="action-horizontal-preview">
    <x-ui.card class="action-horizontal-preview__inner" size="small" color="dark" :body="false">
        <div class="action-horizontal-preview__image">
            {{ $image }}
        </div>

        <div class="action-horizontal-preview__content">
            <div class="action-horizontal-preview__description">
                <div class="action-horizontal-preview__title">{{ $title }}</div>
                {{ $slot }}
            </div>
            <div class="action-horizontal-preview__buttons">
                @if($edit)
                    <x-ui.form.button
                        tag="a"
                        link="{{ route($routePrefix.'.edit', $slug ? $model->slug : $model->id) }}"
                        color="warning"
                        only-icon="true"
                        size="small"
                        title="{{ __('common.edit') }}">
                        <x-slot:icon class="button__icon-wrapper_edit">
                            <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                        </x-slot:icon>
                    </x-ui.form.button>
                @endif

                @if($delete)
                    <div x-data x-on:keydown.escape.window="$store.modalSingleDelete.hide = true">
                        <div x-on:click.stop="
                            $store.modalSingleDelete.hide = ! $store.modalSingleDelete.hide
                            $store.modalSingleDelete.action = '{{ route($routePrefix.'.destroy', $slug ? $model->slug : $model->id) }}'
                            $store.modalSingleDelete.name = '{{ addslashes($model->name) }}'
                            ">
                            <x-ui.form.button
                                tag="div"
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
                @endif
            </div>
        </div>
    </x-ui.card>
</div>

@if($delete)
    @pushonce('modals')
    <x-ui.modal x-data tag="section" ::class="$store.modalSingleDelete.hide ? '' : 'modal_show'">
        <x-ui.modal.content
            x-on:click.outside="$store.modalSingleDelete.hide = true">
            <x-ui.modal.close x-on:click="$store.modalSingleDelete.hide = true" />

            <x-ui.modal.header>
                <x-ui.title
                    size="normal"
                    indent="normal">
                    {{ __('common.deleting') }}
                </x-ui.title>
            </x-ui.modal.header>

            <x-ui.modal.body>
                {{ __('common.delete_confirmation') }} <span x-text="$store.modalSingleDelete.name"></span>?
            </x-ui.modal.body>

            <x-ui.modal.footer align-buttons="right">
                <x-ui.form class="modal__footer-buttons" method="delete" x-bind:action=$store.modalSingleDelete.action>
                    <x-ui.form.button class="modal__footer-button" x-bind:disabled="preventSubmit">
                        {{ __('common.delete') }}
                    </x-ui.form.button>

                    <x-ui.form.button
                        class="modal__footer-button"
                        x-on:click.prevent="$store.modalSingleDelete.hide = true"
                        color="cancel">
                        {{ __('common.close') }}
                    </x-ui.form.button>
                </x-ui.form>
            </x-ui.modal.footer>
        </x-ui.modal.content>
    </x-ui.modal>
    @endpushonce

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('modalSingleDelete', {
                    hide: true,
                    action: false,
                    name: false
                });
            });
        </script>
    @endpush
@endif
