@props([
    'item',
    'model',
    'show' => false,
    'edit' => true,
    'slug' => true
])

@aware([
    'delete' => true
])

<div
    {{ $attributes->class([
        'action-table__buttons'
        ])
    }}>

    {{ $slot }}

    @can('view', $item)
        @if($show)
            <x-ui.form.button
                tag="a"
                link="{{ route($model.'.show',$slug ? $item->slug : $item->id) }}"
                color="info"
                only-icon="true"
                size="small"
                title="{{ __('common.edit') }}">
                <x-slot:icon class="button__icon-wrapper_view">
                    <x-svg.view class="button__icon button__icon_small"></x-svg.view>
                </x-slot:icon>
            </x-ui.form.button>
        @endif
    @endcan

    @can('update', $item)
        @if($edit)
            <x-ui.form.button
                tag="a"
                link="{{ route($model.'.edit', $slug ? $item->slug : $item->id) }}"
                color="warning"
                only-icon="true"
                size="small"
                title="{{ __('common.edit') }}">
                <x-slot:icon class="button__icon-wrapper_edit">
                    <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                </x-slot:icon>
            </x-ui.form.button>
        @endif
    @endcan

    @can('delete', $item)
        @if($delete)
            <div x-data x-on:keydown.escape.window="$store.modalSingleDelete.hide = true">
                <div x-on:click.stop="
                    $store.modalSingleDelete.hide = ! $store.modalSingleDelete.hide;
                    $store.modalSingleDelete.action = '{{ route($model.'.destroy', $slug ? $item->slug : $item->id) }}'
                    $store.modalSingleDelete.name = '{{ addslashes($item->name) }}'
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
    @endcan
</div>
