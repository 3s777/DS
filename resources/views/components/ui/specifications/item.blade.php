@props([
    'title',
    'titleClass' => false,
    'valueClass' => false,
])

<div {{ $attributes->class([
            'specifications__item',
        ])
    }}>
    <dt class="specifications__item-title {{ $titleClass }}">
        {{ $title }}:
    </dt>
    <dd class="specifications__item-value {{ $valueClass }}">
        {{ $slot }}
    </dd>
</div>
