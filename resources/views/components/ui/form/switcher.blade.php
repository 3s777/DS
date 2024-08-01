@props([
    'name',
    'label' => '',
    'error' => false,
    'checked' => false
])

<label class="switcher">
    <input
           {{ $attributes->class(['switcher__checkbox']) }}
           @if($checked)
               checked
           @endif
           type="checkbox"
           name="{{ $name }}">
    <span class="switcher__button"></span>
    <span class="switcher__label @if($errors->has($name)) switcher__label_error @endif">{{ $label }}</span>
</label>
