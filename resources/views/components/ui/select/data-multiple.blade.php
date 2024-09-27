<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    :name="$selectName"
    :label="$label"
    :error="$filteredName"
    :required="$required"
    multiple>

    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    {{ $slot }}

    @foreach($options as $value => $option)
        <x-ui.form.option
            :value="$value"
            :selected="$isSelected($value)">
            {{ $option }}
        </x-ui.form.option>
    @endforeach
</x-libraries.choices>

@push('scripts')
    <script type="module">
        const {{ $name }} = document.querySelector('.choices-{{ $name }}');
        new Choices({{ $name }}, {
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            noResultsText: '{{ __('common.not_found') }}',
            noChoicesText: '{{ __('common.nothing_else') }}',
        });
    </script>
@endpush
