@props([
    'id',
    'name',
    'label' => '',
    'errors' => false,
    'size' => false,
    'checked' => false
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
                    'checked' => $checked,
                    'name' => $name,
                    'id' => $id
                ]) }}
    >

    <label class="input-checkbox__label" for="{{ $id }}">
        <span class="input-checkbox__label-wrapper">{{ $label }}</span>
    </label>
</div>
