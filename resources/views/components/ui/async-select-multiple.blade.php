@props([
    'name',
    'route',
    'label' => false,
    'selected' => false,
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

    @if($defaultOption && !$selected)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    @if($selected)
        @if(!old($name) || !$showOld)
            @foreach($selected as $item)
                <x-ui.form.option value="{{ $item->id }}" :selected="true">
                    {{ $item->name }}
                </x-ui.form.option>
            @endforeach
        @endif
    @endif

    @if(old($name) && $showOld)
        @foreach(old('old_selected_'.$name.'_label')['old'] as $key => $value)
            <x-ui.form.option value="{{ $key }}" selected>
                {{ $value }}
            </x-ui.form.option>
        @endforeach
    @endif

</x-libraries.choices>

    @if($showOld)
        @if($selected && !old($name))
            @foreach($selected as $item)
                <input type="hidden" class="old_selected_{{ $name }}_label" name="old_selected_{{ $name }}_label[old][{{ $item->id }}]" value="{{ $item->name }}">
            @endforeach
        @endif

        @if(old($name))
            @foreach(old('old_selected_'.$name.'_label')['old'] as $key => $value)
                <input type="hidden" class="old_selected_{{ $name }}_label" name="old_selected_{{ $name }}_label[old][{{ $key }}]" value="{{ $value }}">
            @endforeach
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
            placeholder: false,
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

                const selectedInputs = document.getElementsByClassName('old_selected_{{ $name }}_label');



                while(selectedInputs.length > 0){
                    selectedInputs[0].parentNode.removeChild(selectedInputs[0]);
                }


                const selectedForm = select{{ $name }} .closest('form');


                    let values = Array.from(options).reduce(function(oldOptions, currentOption) {
                    oldOptions[currentOption.value] = currentOption.text;
                    return oldOptions;
                }, {});

                // console.log(values)


                for (const key in values) {
                    if(key) {
                        const input = document.createElement("input");
                        input.type = "text";
                        input.className = "old_selected_{{ $name }}_label";
                        input.name = "old_selected_{{ $name }}_label[old][" + key + "]";
                        input.value = values[key];

                        selectedForm.appendChild(input);
                    }


                    // console.log( "Ключ: " + key + " значение: " + values[key] );
                }

            };
        @endif
    </script>
@endpush
