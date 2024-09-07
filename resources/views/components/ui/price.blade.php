@props([
    'value',
    'currency',
    'standard' => true,
    'discount' => false,
    'old' => false,
    'color' => 'dark',
    'prefix' => false
])

<div {{ $attributes->class([
        'price',
        'price_standard' => $standard,
        'price_color_'.$color => $color
        ])
    }}>
    <div class="price__value
        {{ $prefix ? $prefix.'__price-value' : '' }}
        {{ $old ? 'price__value_old' : '' }}">
            {{ $value }}
    </div>
    <div class="price__currency {{ $prefix ? $prefix.'__price-currency' : '' }} ">{{ $currency }}</div>
    @if($discount)
        <div class="price__discount">-{{ $discount }}%</div>
    @endif
</div>
