@props([
    'id',
    'label',
    'name',
    'value' => false,
    'color' => false,
    'indent' => false,
    'size' => false,
    'label_class' => false,
    'checked' => false
])

<div
    {{ $attributes->class([
            'radio-button',
            'radio-button_indent_'.$indent => $indent,
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
        class="radio-button__label {{ $label_class }}"
        color="{{ $color }}"
        size="{{ $size }}"
        for="{{ $id }}">
        {{ $label }}
    </x-ui.form.button>
</div>
