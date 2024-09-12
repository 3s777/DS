@props([
    'name',
    'route',
    'dependOn',
    'dependField',
    'label' => false,
    'selected' => false,
    'showOld' => true,
    'defaultOption' => false,
    'arrayKey' => false,
])

<x-libraries.choices
    {{ $attributes->class([
        $name.'-select' => $name
    ]) }}
    id="{{ $name }}-select"
    :name="$arrayKey ? $arrayKey.'['.$name.'][]' : $name.'[]'"
    :label="$label"
    :error="$name"
    multiple>

    @if($defaultOption && !$selected)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    @if($selected)
        @if(!old($name) || !$showOld)
            @foreach($selected as $item)
                <x-ui.form.option :value="$item->id" :selected="true">
                    {{ $item->name }}
                </x-ui.form.option>
            @endforeach
        @endif
    @endif

    @if(old($name) && $showOld)
        @foreach(old('old_selected_'.$name)['old'] as $key => $value)
            <x-ui.form.option :value="$key" :selected="true">
                {{ $value }}
            </x-ui.form.option>
        @endforeach
    @endif
</x-libraries.choices>

@if($showOld)
    @if($selected && !old($name))
        @foreach($selected as $item)
            <input type="hidden" class="old_selected_{{ $name }}" name="old_selected_{{ $name }}[old][{{ $item->id }}]" value="{{ $item->name }}">
        @endforeach
    @endif

    @if(old($name))
        @foreach(old('old_selected_'.$name)['old'] as $key => $value)
            <input type="hidden" class="old_selected_{{ $name }}" name="old_selected_{{ $name }}[old][{{ $key }}]" value="{{ $value }}">
        @endforeach
    @endif
@endif
@dump($dependOn)
@dump(old())
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


        @if($dependOn)
            const {{ $name }}Depended = document.querySelector('.{{ $dependOn }}-select');

            const dependData = {};

            choices{{ $name }}.disable();

            {{ $name }}Depended.addEventListener(
                'addItem',
                function(event) {
                    choices{{ $name }}.enable();
                    dependData['{{ $dependField }}'] = event.detail.value
                },
                false,
            );


            {{ $name }}Depended.addEventListener(
                'removeItem',
                function(event) {
                    choices{{ $name }}.disable();
                    choices{{ $name }}.clearStore();
                },
                false,
            );

            @if(old($name) && $showOld)
                choices{{ $name }}.enable();
                dependData['{{ $dependField }}'] = {{ $name }}Depended.value;
            @endif

            @if(old($dependOn) && $showOld)
                choices{{ $name }}.enable();
                dependData['{{ $dependField }}'] = {{ $name }}Depended.value;
            @endif
        @endif


        asyncSelect.searchTerms.addEventListener(
            'input',
            debounce(event => asyncSelect.asyncSearch(choices{{ $name }} @if($dependOn) ,dependData @endif), 300),
            false,
        )

        @if($showOld)
            let select{{ $name }} = document.querySelector(`[name="{{ $name }}[]"]`);

            let selectedForm = select{{ $name }} .closest('form');

            let options = select{{ $name }}.selectedOptions;

            select{{ $name }}.onchange = function () {

                const selectedInputs = document.getElementsByClassName('old_selected_{{ $name }}');

                while(selectedInputs.length > 0){
                    selectedInputs[0].parentNode.removeChild(selectedInputs[0]);
                }

                let values = Array.from(options).reduce(function(oldOptions, currentOption) {
                    oldOptions[currentOption.value] = currentOption.text;
                    return oldOptions;
                }, {});

                for (const key in values) {
                    if(key) {
                        const input = document.createElement("input");
                        input.type = "hidden";
                        input.className = "old_selected_{{ $name }}";
                        input.name = "old_selected_{{ $name }}[old][" + key + "]";
                        input.value = values[key];

                        selectedForm.appendChild(input);
                    }
                }
            };
        @endif
    </script>
@endpush
