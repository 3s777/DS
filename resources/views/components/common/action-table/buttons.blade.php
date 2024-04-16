@props([
    'item',
    'model',
    'show' => false,
    'edit' => true,
    'delete' => true
])

<div
    {{ $attributes->class([
        'action-table__buttons'
        ])
    }}>

    {{ $slot }}

    @if($show)
        <x-ui.form.button
            tag="a"
            link="{{ route($model.'.show', $item->slug) }}"
            color="info"
            only-icon="true"
            size="small"
            title="{{ __('common.edit') }}">
            <x-slot:icon class="button__icon-wrapper_view">
                <x-svg.view class="button__icon button__icon_small"></x-svg.view>
            </x-slot:icon>
        </x-ui.form.button>
    @endif

    @if($edit)
        <x-ui.form.button
            tag="a"
            link="{{ route($model.'.edit', $item->slug) }}"
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
        <div x-data x-on:keydown.escape.window="$store.modalDelete.hide = true">
            <div x-on:click.stop="
                $store.modalDelete.hide = ! $store.modalDelete.hide;
                $store.modalDelete.action = '{{ route($model.'.destroy', $item->slug) }}'
                $store.modalDelete.name = '{{  $item->name }}'
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
    @endif
</div>
