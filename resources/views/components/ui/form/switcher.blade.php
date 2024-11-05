@props([
    'name',
    'label' => '',
    'checked' => false,
    'value' => false
])

<label class="switcher">
    <input
           {{ $attributes->class(['switcher__checkbox'])
                ->merge([
                    'type' => 'checkbox',
                    'name' => $name,
                    'value' => $value,
                    'checked' => old(to_dot_name($name)) ? old(to_dot_name($name)) : $checked
                ]) }}>
    <span class="switcher__button"></span>
    <span class="switcher__label @if($errors->has($name)) switcher__label_error @endif">{{ $label }}</span>
</label>
