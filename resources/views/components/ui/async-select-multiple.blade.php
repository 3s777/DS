@props([
    'name',
    'route',
    'label' => false,
    'selected' => false,
    'selectName' => false,
    'showOld' => true,
    'defaultOption' => false,
])

<x-libraries.choices
    {{ $attributes->class([
        $name.'-select' => $name
    ]) }}
    id="{{ $name }}-select"
    :name="$name.'[]'"
    label="{{ $label }}"
    multiple>

    @if($selected)
        @foreach($selected as $item)
            <x-ui.form.option value="{{ $item->id }}" :selected="!old($name)">
                {{ $item->name }}
            </x-ui.form.option>
        @endforeach
    @endif

    @if($defaultOption && !$selected)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

{{--    @if(old($name) && $showOld)--}}
{{--        @foreach(old($name) as $old)--}}
{{--            <x-ui.form.option value="{{ $old }}" selected>--}}
{{--                {{ old('old_selected_'.$name.'_label') }}--}}
{{--            </x-ui.form.option>--}}
{{--        @endforeach--}}
{{--    @endif--}}

</x-libraries.choices>

    @if($showOld)
        @if($selected)
            @foreach($selected as $item)
                <input type="hidden" name="old_selected_{{ $name }}_label[old][{{ $item->id }}]" value="{{ $item->name }}">
            @endforeach
        @else
            <input type="hidden" name="old_selected_{{ $name }}_label[][]" value="{{ old('old_selected_'.$name.'_label') }}" id="old_selected_{{ $name }}_label">

        @endif
    @endif

@push('scripts')
    <script type="module">
        const {{ $name }}List = document.querySelector('.{{ $name }}-select');

        let asyncSelect = new asyncSelectSearch('{{ route($route) }}');

        const choices{{ $name }} = new Choices({{ $name }}List, {
            allowHTML: true,
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            noResultsText: '{{ __('common.loading') }}',
            noChoicesText: '{{ __('common.not_found') }}',
            searchPlaceholderValue: '{{ __('common.search') }}',
            callbackOnInit: () => {
                asyncSelect.searchTerms = {{ $name }}List.closest('.choices').querySelector('[name="search_terms"]')
            },
        });

        asyncSelect.searchTerms.addEventListener(
            'input',
            debounce(event => asyncSelect.asyncSearch(choices{{ $name }}), 300),
            false,
        )

        @if($showOld)
            let select{{ $name }} = document.querySelector(`[name="{{ $name }}[]"]`);

            let selected{{ $name }}Name = document.getElementById('old_selected_{{ $name }}_label');



        var options = select{{ $name }}.selectedOptions;

        // var values = Array.from(options).map(
        //     ({ text, value }) => value
        //
        //     // function (item, index) {
        //     //     console.log("элемент:", item)
        //     //     return index
        //     // }
        // );





            select{{ $name }}.onchange = function () {

                var values = Array.from(options).reduce(function(oldOptions, currentOption) {
                    oldOptions[currentOption.value] = currentOption.text;
                    return oldOptions;
                }, {});

                console.log(values)


                selected{{ $name }}Name.value = select{{ $name }}.options[select{{ $name }}.selectedIndex].text;
            };
        @endif
    </script>
@endpush
