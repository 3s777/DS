@props([
    'title',
    'titleClass' => false,
    'valueClass' => false,
    'type' => false
])

<div {{ $attributes->class([
            'specifications__item',
            'specifications__item_'.$type => $type
        ])
    }}>
    <dt class="specifications__item-title {{ $titleClass }}">
        {{ $title }}:
    </dt>
    <dd class="specifications__item-value {{ $valueClass }}">
        {{ $slot }}
    </dd>
</div>
