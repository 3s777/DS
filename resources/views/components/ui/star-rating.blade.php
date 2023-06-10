@props([
    'name',
    'title' => false,
    'count' => 10,
    'none_button' => false,
])

<fieldset {{ $attributes->class([
            'star-rating',
        ]) }}>

    <legend class="star-rating__title">{{ $title }}:</legend>
    <div class="star-rating__group">

        <input style="display: none" class="star-rating__input" name="star-rating_{{ $name }}" value="" type="radio" checked>

        @unless($none_button)
            <input class="star-rating__input star-rating__input_none" name="star-rating_{{ $name }}" id="star-rating_{{ $name }}-none" value="none" type="radio">
            <label aria-label="No star-rating" class="star-rating__label star-rating__label_none" title="Отсутствует" for="star-rating_{{ $name }}-none">
                <x-svg.cancel class="star-rating__icon star-rating__icon_none"></x-svg.cancel>
            </label>
        @endunless

        @for ($i = 1; $i <= $count; $i++)
            <label aria-label="{{ $i }} star" class="star-rating__label" for="star-rating_{{ $name }}-{{ $i }}">
                <x-svg.star class="star-rating__icon star-rating__icon_star"></x-svg.star>
            </label>
            <input class="star-rating__input" name="star-rating_{{ $name }}" id="star-rating_{{ $name }}-{{ $i }}" value="{{ $i }}" type="radio">
        @endfor
    </div>
</fieldset>
