@props([
    'rating',
    'maxValue' => '10',
    'title' => 'Рейтинг',
    'classPrefix' => false
])

<div
    {{ $attributes->class([
            'rating',
            'user-rating'
        ])
    }}>
    @if($title)
        <div class="rating__title {{ ($classPrefix) ? $classPrefix.'__rating-title': '' }}">{{ __($title) }}</div>
    @endif
    <div class="rating__value {{ ($classPrefix) ? $classPrefix.'__rating-value': '' }}">
        <a href="#">{{ $rating }}/{{ $maxValue }}</a>
    </div>
</div>
