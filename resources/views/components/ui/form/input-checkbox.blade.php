@props([
    'id',
    'name',
    'label' => '',
    'errors' => false,
    'value' => false,
    'size' => false
])

<div class="input-checkbox">
    <input
           {{ $attributes
                ->class([
                    'input-checkbox__field',
                    'input-checkbox__field_error' => $errors->has($name),
                    'input-checkbox__field_size_'.$size => $size,
                ])
                ->merge([
                    'type'=>'checkbox',
                    'checked' => $value == 1,
                    'name' => $name,
                    'id' => $id
                ]) }}
    >

    <label class="input-checkbox__label" for="{{ $id }}">
        {{ $label }}
    </label>
</div>
