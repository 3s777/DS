@props([
    'title',
    'title_class' => false,
    'value_class' => false,
])

<div {{ $attributes->class([
            'specifications__item',
        ])
    }}>
    <dt class="specifications__item-title {{ $title_class }}">
        {{ $title }}:
    </dt>
    <dd class="specifications__item-value {{ $value_class }}">
        {{ $slot }}
    </dd>
</div>
