@props([
    'id',
    'name',
    'placeholder' => '',
    'value' => '',
    'error' => false
])

<div class="datepicker">
    <label class="datepicker__label" for="{{ $id }}">{{ $placeholder }}</label>
    <input
           {{ $attributes->class(['datepicker__field', 'datepicker__field_error' => $errors->has($name)]) }}
           id="{{ $id }}"
           type="date"
           name="{{ $name }}"
           value="{{ $value }}" >
</div>
