@props([
    'id',
    'name',
    'placeholder' => '',
    'value' => '',
    'type' => 'text',
    'errors' => false
])

<div class="input-text">
    <input
           {{ $attributes->class(['input-text__field', 'input-text__field_error' => $errors->has($name)]) }}
           value="{{ $value }}"
           name="{{ $name }}"
           id="{{ $id }}"
           type="{{ $type }}"
    >
    <label class="input-text__label" for="{{ $id }}">{{ $placeholder }}</label>
</div>
