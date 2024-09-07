@props([
    'name' => false,
    'type' => false,
    'sortable' => false,
])

<div
    {{ $attributes->class([
            'responsive-table__column',
            'responsive-table__column_'.$type => $type
        ])
    }}>
    @if($sortable)
        <div class="responsive-table__sortable">
            {{ $slot }}
            <x-ui.responsive-table.order name="{{ $name }}" />
        </div>
    @else
        {{ $slot }}
    @endif
</div>
