@props([
    'name',
    'route',
    'label' => false,
    'selected' => false,
    'selectName' => false,
    'showOld' => true,
    'defaultOption' => false
])

<x-libraries.choices
    {{ $attributes->class([
        $name.'-select' => $name
    ]) }}
    id="{{ $name }}-select"
    :name="$selectName ?: $name.'_id'"
    label="{{ $label }}">

    @if($selected)
        <x-ui.form.option value="{{ $selected->id }}" :selected="!old('{{ $name }}_id')">
            {{ $selected->name }}
        </x-ui.form.option>
    @else
        @if($defaultOption)
            <x-ui.form.option value="">
                {{ $defaultOption }}
            </x-ui.form.option>
        @endif
    @endif

    @if(old($name.'_id') && $showOld)
        <x-ui.form.option value="{{ old($name.'_id') }}" selected>
            {{ old('old_selected_'.$name.'_label') }}
        </x-ui.form.option>
    @endif

</x-libraries.choices>

    @if($showOld)
        <input type="hidden" name="old_selected_{{ $name }}_label" value="" id="old_selected_{{ $name }}_label">
    @endif

@push('scripts')
    <script type="module">
        const {{ $name }}List = document.querySelector('.{{ $name }}-select');

        let asyncSelect = new asyncSelectSearch('{{ route($route) }}');

        const choices{{ $name }} = new Choices({{ $name }}List, {
            allowHTML: true,
            itemSelectText: '',
            noResultsText: '{{ __('common.loading') }}',
            noChoicesText: '{{ __('common.not_found') }}',
            searchPlaceholderValue: '{{ __('common.search') }}',
            callbackOnInit: () => {
                asyncSelect.searchTerms = {{ $name }}List.closest('.choices').querySelector('[name="search_terms"]')
            },
        });

        asyncSelect.searchTerms.addEventListener(
            'input',
            event => choices{{ $name }}.clearStore(),
            false,
        )

        asyncSelect.searchTerms.addEventListener(
            'input',
            debounce(event => asyncSelect.asyncSearch(choices{{ $name }}), 300),
            false,
        )

        @if($showOld)
            @if($selectName)
                let select{{ $name }} = document.querySelector(`[name="{{ $selectName }}"]`);
            @else
                let select{{ $name }} = document.querySelector(`[name="{{ $name }}_id"]`);
            @endif

            let selected{{ $name }}Name = document.getElementById('old_selected_{{ $name }}_label');

            select{{ $name }}.onchange = function () {
                selected{{ $name }}Name.value = select{{ $name }}.options[select{{ $name }}.selectedIndex].text;
            };
        @endif
    </script>
@endpush
