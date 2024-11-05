@props([
    'id',
    'name',
    'placeholder' => '',
    'value' => '',
])

<div class="datepicker">
    <label class="datepicker__label" for="{{ $id }}">{{ $placeholder }}</label>
    <input
           {{ $attributes->class(['datepicker__field', 'datepicker__field_error' => $errors->has($name)]) }}
           id="{{ $id }}"
           type="date"
           name="{{ $name }}"
           value="{{ old(to_dot_name($name)) ? old(to_dot_name($name)) : $value }}" >
</div>
