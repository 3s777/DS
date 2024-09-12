@props([
    'id',
    'name',
    'label' => '',
    'value' => ''
])

<div class="radio">
    <input
        {{ $attributes->class(['radio__input']) }}
        @if($value)
            checked
        @endif
        type="radio"
        name="{{ $name }}"
        id="{{ $id }}" />
    <label class="radio__label" for="{{ $id }}">{{ $label }}</label>
</div>
