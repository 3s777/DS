@props([
    'value',
    'currency',
    'discount' => false,
    'old' => false,
    'color' => 'dark'
])

<x-ui.tag {{ $attributes->class(['price']) }} color="{{ $color }}" disabled="true">
    <span class="price__value {{ $old ? 'price__value_old' : '' }}">{{ $value }}</span>
    <span class="price__currency">{{ $currency }}</span>
    @if($discount)
        <div class="price__discount">-{{ $discount }}%</div>
    @endif
</x-ui.tag>
