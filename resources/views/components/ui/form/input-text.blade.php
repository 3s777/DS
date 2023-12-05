@props([
    'id',
    'name',
    'placeholder' => '',
    'value' => '',
    'type' => 'text',
    'errors' => false,
    'wrapperClass' => false,
    'fullWidth' => true
])

<div class="input-text
    @if($fullWidth) input-text_full-width @endif
    @if($wrapperClass) {{ $wrapperClass }} @endif ">
    <input
           {{ $attributes->class(['input-text__field', 'input-text__field_error' => $errors->has($name)]) }}
           value="{{ $value }}"
           name="{{ $name }}"
           id="{{ $id }}"
           type="{{ $type }}"
           placeholder=""
    >
    <label class="input-text__label" for="{{ $id }}">{{ $placeholder }}</label>
</div>
