@props([
    'id',
    'name',
    'label' => false,
    'input' => false,
    'value' => false,
    'show_label' => true,
    'wrapper_class' => false,
])

<div class="choices-block {{ $wrapper_class }}">
    @if($show_label)
        <label class="choices-block__label" for="{{ $id }}">{{ $label }}</label>
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
                    'name' => $name,
                ])
            }}>
            {{ $slot }}
        </x-ui.form.select>
    @endif



</div>
