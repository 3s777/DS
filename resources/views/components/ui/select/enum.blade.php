<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    :required="$required"
    :multiple="$multiple"
    :name="$selectName"
    :label="$label"
    :error="$filteredName">

    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    @foreach($options as $option)
        <x-ui.form.option
            :value="$getValue($option)"
            :selected="$isSelected($getValue($option))">
                {{ $option->name() }}
        </x-ui.form.option>
    @endforeach
</x-libraries.choices>

@if($scripts)
    @push('scripts')
        <script type="module">
            const {{ $name }} = document.querySelector('.choices-{{ $name }}');
            new Choices({{ $name }}, {
                allowHTML: true,
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                noResultsText: '{{ __('common.not_found') }}',
                noChoicesText: '{{ __('common.nothing_else') }}',
            });
        </script>
    @endpush
@endif
