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
        {{ $attributes->class(['radio-button__input'])
                ->merge([
                    'type' => 'radio',
                    'id' => $id,
                    'name' => $name,
                    'value' => $value,
                    'checked' => old(to_dot_name($name)) ? old(to_dot_name($name)) == $value : $checked
                ]) }}>

    <x-ui.form.button
        tag="label"
        class="radio-button__label {{ $labelClass }} @if($group) radio-group__label @endif"
        color="{{ $color }}"
        size="{{ $size }}"
        for="{{ $id }}">
        {{ $label }}
    </x-ui.form.button>
</div>
