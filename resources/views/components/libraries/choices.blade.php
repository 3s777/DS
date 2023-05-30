@props([
    'id',
    'name',
    'label' => false,
    'checked' => false
])

<div class="choices-block">
    <label class="choices-block__label" for="{{ $id }}">{{ $label }}</label>
    <select class="choices-select-1" id="{{ $id }}" name="{{ $name }}" >
        {{ $slot }}
    </select>
</div>
