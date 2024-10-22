@props([
    'id',
    'label',
    'name',
    'value' => false,
    'color' => false,
    'indent' => false,
    'size' => false,
    'labelClass' => false,
    'checked' => false,
    'group' => false
])

<div
    {{ $attributes->class([
            'radio-button',
            'radio-button_indent_'.$indent => $indent,
            'radio-group__button' => $group
        ])
    }}>

    <input
        class="radio-button__input"
        id="{{ $id }}"
        type="radio"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}>

    <x-ui.form.button
        tag="label"
        class="radio-button__label {{ $labelClass }} @if($group) radio-group__label @endif"
        color="{{ $color }}"
        size="{{ $size }}"
        for="{{ $id }}">
        {{ $label }}
    </x-ui.form.button>
</div>
