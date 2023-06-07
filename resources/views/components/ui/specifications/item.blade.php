@props([
    'title',
    'title_class' => false,
    'value_class' => false,
])

<div {{ $attributes->class([
            'specifications__item',
        ])
    }}>
    <div class="specifications__item-title {{ $title_class }}">
        {{ $title }}:
    </div>
    <div class="specifications__item-value {{ $value_class }}">
        {{ $slot }}
    </div>
</div>
