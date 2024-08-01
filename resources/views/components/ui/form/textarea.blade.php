@props([
    'id',
    'name',
    'placeholder' => '',
    'error' => false
])

<div class="textarea">
    <textarea
        {{ $attributes->class(['textarea__field', 'textarea__field_error' => $errors->has($name)]) }}
        class="textarea__field"
        placeholder="{{ $placeholder }}"
        name="{{ $name }}"
        id="{{ $id }}">{{ $slot }}</textarea>
    <label class="textarea__label" for="{{ $id }}">{{ $placeholder }}</label>
</div>
