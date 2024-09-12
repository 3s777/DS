@props([
    'id',
    'name',
    'label' => false,
    'input' => false,
    'value' => false,
    'wrapperClass' => false,
    'size' => false,
    'error' => false,
    'required' => false
])

<div class="
    choices-block
    {{ $wrapperClass }}
    @if($size) choices-block_size_{{$size}} @endif

    {{--    check errors for select one || select multiple with $errors--}}
    @if($errors->has($name) || $errors->has($error)) choices-block_error @endif">

    @if($label)
        <label class="choices-block__label" for="{{ $id }}">{{ $label }} @if($required)  * @endif</label>
    @endif

    @if($input)
        <input
            {{ $attributes->class([
                    'choices-block__select',
                ])
                ->merge([
                    'id' => $id,
                    'name' => $name,
                    'value' => $value,
                    'type' => 'text'
                ])
            }}>
    @else
        <x-ui.form.select
            {{ $attributes->class([
                    'choices-block__select',
                ])
                ->merge([
                    'id' => $id,
                    'name' => $name
                ])
            }}>
            {{ $slot }}
        </x-ui.form.select>
    @endif
</div>
