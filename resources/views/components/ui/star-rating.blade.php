@props([
    'name',
    'type' => false,
    'title' => false,
    'count' => 10,
    'numClass'=> false,
    'noneButton' => false,
    'value' => false,
    'labelClass' => false,
    'groupClass' => false
])
    <fieldset {{ $attributes->class([
            'star-rating',
            'star-rating_'.$type => $type,
            'star-rating_'.$numClass => $numClass
        ]) }}>

        <legend class="star-rating__title">{{ $title }}:</legend>
        <div class="star-rating__group @if($groupClass) {{$groupClass}} @endif">

            <input style="display: none" class="star-rating__input" name="star-rating_{{ $name }}" value="" type="radio" checked>

            @unless($noneButton)
                <input
                    class="star-rating__input star-rating__input_none"
                    name="star-rating_{{ $name }}"
                    id="star-rating_{{ $name }}-none"
                    value="none"
                    type="radio"
                    @if($value == 'none') checked @endif
                >
                <label aria-label="No star-rating" class="star-rating__label star-rating__label_none @if($labelClass) {{$labelClass}}_none @endif" title="Отсутствует" for="star-rating_{{ $name }}-none">
                    <x-svg.cancel class="star-rating__icon star-rating__icon_none"></x-svg.cancel>
                </label>
            @endunless

            @for ($i = 1; $i <= $count; $i++)
                <label aria-label="{{ $i }} star" class="star-rating__label @if($labelClass) {{$labelClass}} @endif" for="star-rating_{{ $name }}-{{ $i }}">
                    <x-svg.star class="star-rating__icon star-rating__icon_star"></x-svg.star>
                </label>
                <input
                    class="star-rating__input"
                    name="star-rating_{{ $name }}"
                    id="star-rating_{{ $name }}-{{ $i }}"
                    value="{{ $i }}"
                    type="radio"
                    @if($value == $i) checked @endif
                >
            @endfor
        </div>
    </fieldset>


