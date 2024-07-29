@props([
    'name',
    'list',
    'placeholder' => get_filter($name)->placeholder()
])

<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    name="filters[{{ $name }}][]"
    :error="$errors->has($name)"
    label="{{ $placeholder }}" multiple="">
    <x-ui.form.option value="">{{ get_filter($name)->title() }}</x-ui.form.option>
    @foreach($list as $item)
        <x-ui.form.option
            value="{{ $item['id'] }}"
            :selected="request('filters.{{ $name }}') && in_array($item['id'], request('filters.{{ $name }}'))">
            {{ $item['name'] }}
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
