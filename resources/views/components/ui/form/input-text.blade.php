@props([
    'id',
    'name',
    'placeholder' => '',
    'value' => '',
    'type' => 'text',
    'wrapperClass' => false,
    'fullWidth' => true,
    'required' => false,
    'showOld' => true
])
<div class="input-text
    @if($fullWidth) input-text_full-width @endif
    @if($wrapperClass) {{ $wrapperClass }} @endif ">
    <input
           {{ $attributes
                ->class(['input-text__field', 'input-text__field_error' => $errors->has(to_dot_name($name))])
                ->merge([
                    'required' => $required,
                    'value' => old(to_dot_name($name)) && $showOld ? old(to_dot_name($name)) : $value,
                    'name' => $name,
                    'id' => $id,
                    'type' => $type,
                    'placeholder' => ''
                    ])
                }}>
    <label class="input-text__label" for="{{ $id }}">{{ $placeholder }} @if($required) * @endif</label>
</div>
