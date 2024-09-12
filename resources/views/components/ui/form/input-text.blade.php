@props([
    'id',
    'name',
    'placeholder' => '',
    'value' => '',
    'type' => 'text',
    'wrapperClass' => false,
    'fullWidth' => true,
    'required' => false
])
<div class="input-text
    @if($fullWidth) input-text_full-width @endif
    @if($wrapperClass) {{ $wrapperClass }} @endif ">
    <input
           {{ $attributes
                ->class(['input-text__field', 'input-text__field_error' => $errors->has($name)])
                ->merge([
                    'required' => $required,
                    'value' => $value,
                    'name' => $name,
                    'id' => $id,
                    'type' => $type,
                    'placeholder' => ''
                    ]
                ) }}>
    <label class="input-text__label" for="{{ $id }}">{{ $placeholder }} @if($required) * @endif</label>
</div>
