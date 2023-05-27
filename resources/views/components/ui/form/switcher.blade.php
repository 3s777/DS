@props([
    'name',
    'label' => '',
    'errors' => false,
    'value' => ''
])

<label class="switcher">
    <input
           {{ $attributes->class(['switcher__checkbox']) }}
           @if($value)
               checked
           @endif
           type="checkbox"
           name="{{ $name }}">
    <span class="switcher__button"></span>
    <span class="switcher__label @if($errors->has($name)) switcher__label_error @endif">{{ $label }}</span>
</label>
