@props([
    'name',
    'placeholder' => false,
    'defaultOption' => false,
    'value' => false
])

<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    name="{{ $name }}"
    :error="$name"
    :label="$placeholder"
    input="true"
    :value="old() ? old($name) : $value"
    >
</x-libraries.choices>

@push('scripts')
    <script type="module">
        const {{ $name }} = document.querySelector('.choices-{{ $name }}');
        new Choices({{ $name }}, {
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            placeholder: true,
            duplicateItemsAllowed: false,
            delimiter: '||',
            placeholderValue: '{{ __($defaultOption) }}',
            noResultsText: '{{ __('common.not_found') }}',
            noChoicesText: '{{ __('common.nothing_else') }}',
            uniqueItemText: '{{ __('validation.choices_unique') }}',
            addItemText: '{{ __('common.press_enter') }}',
        });
    </script>
@endpush
