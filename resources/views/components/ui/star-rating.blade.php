@props([
    'name',
    'inputName' => false,
    'type' => false,
    'title' => false,
    'responsive' => true,
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
            'star-rating_'.$numClass => $numClass,
            'star-rating_responsive' => $responsive
        ]) }}>

        <legend class="star-rating__title">{{ $title }}:</legend>
        <div class="star-rating__group @if($groupClass) {{$groupClass}} @endif">

            <input style="display: none" class="star-rating__input" name="@if($inputName){{$inputName}}@else{{'star-rating_'.$name }}@endif" value="" type="radio" checked>

            @unless($noneButton)
                <input
                    class="star-rating__input star-rating__input_none"
                    name="@if($inputName){{$inputName}}@else{{'star-rating_'.$name }}@endif"
                    id="star-rating_{{ $name }}--1"
                    value="-1"
                    type="radio"
                    @if($value == '-1') checked @endif
                >
                <label aria-label="No star-rating" class="star-rating__label star-rating__label_none @if($labelClass) {{$labelClass}}_none @endif" title="Отсутствует" for="star-rating_{{ $name }}--1">
                    <x-svg.cancel class="star-rating__icon star-rating__icon_none"></x-svg.cancel>
                </label>
            @endunless

            @for ($i = 1; $i <= $count; $i++)
                <label aria-label="{{ $i }} star" class="star-rating__label @if($labelClass) {{$labelClass}} @endif" for="star-rating_{{ $name }}-{{ $i }}">
                    <x-svg.star class="star-rating__icon star-rating__icon_star"></x-svg.star>
                </label>
                <input
                    class="star-rating__input"
                    name="@if($inputName){{$inputName}}@else{{'star-rating_'.$name }}@endif"
                    id="star-rating_{{ $name }}-{{ $i }}"
                    value="{{ $i }}"
                    type="radio"
                    @if($value == $i) checked @endif
                >
            @endfor
        </div>
    </fieldset>


