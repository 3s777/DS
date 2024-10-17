<x-libraries.choices
    {{ $attributes->class([
        $name.'-select' => $name
    ]) }}
    id="{{ $name }}-select"
    :error="$filteredName"
    :name="$selectName"
    :label="$label"
    :required="$required"
    multiple>

    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif
</x-libraries.choices>

@if($showOld)
    @if($selected && !old($filteredName))
        @foreach($selected as $value => $label)
            <input type="hidden" class="old_selected_{{ $name }}" name="old_selected_{{ $name }}[old][{{ $value }}]" value="{{ $label }}">
        @endforeach
    @endif

    @if(old($filteredName))
        @foreach(old('old_selected_'.$name)['old'] as $key => $value)
            <input type="hidden" class="old_selected_{{ $name }}" name="old_selected_{{ $name }}[old][{{ $key }}]" value="{{ $value }}">
        @endforeach
    @endif
@endif

@push('scripts')
    <script type="module">
        const {{ $name }}List = document.querySelector('.{{ $name }}-select');

        const choices{{ $name }} = new Choices({{ $name }}List, {
            allowHTML: true,
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            loadingText: '{{ __('common.loading')  }}',
            noResultsText: '{{ __('common.not_found') }}',
            noChoicesText: '{{ __('common.not_found') }}',
            searchPlaceholderValue: '{{ __('common.search') }}'
        });

        const {{ $name }}Depended = document.querySelector("[name='{{ $dependOn }}']");

        const dependData = {};

        choices{{ $name }}.disable();

        if({{ $name }}Depended.value !== '') {
            choices{{ $name }}.enable();
            dependData['{{ $dependField }}'] = {{ $name }}Depended.value;

            @if(($selected && !old()) || ($selected && !$showOld))
                choices{{ $name }}.setValue([
                    @foreach($selected as $value => $label)
                        { value: '{{ $value }}', label: '{{ $label }}', selected: true },
                    @endforeach
                ]);
            @endif

            @if((old($filteredName) && $showOld))
                choices{{ $name }}.setValue([
                    @foreach(old('old_selected_'.$name)['old'] as $value => $label)
                        { value: '{{ $value }}', label: '{{ $label }}', selected: true },
                    @endforeach
                ]);
            @endif
        }

        {{ $name }}Depended.addEventListener(
            'addItem',
            function(event) {
                if({{ $name }}Depended.value) {
                    choices{{ $name }}.enable();
                    dependData['{{ $dependField }}'] = event.detail.value
                }
            },
            false,
        );


        {{ $name }}Depended.addEventListener(
            'removeItem',
            function(event) {
                choices{{ $name }}.disable();
                choices{{ $name }}.clearStore();
                delete dependData['{{ $dependField }}'];
            },
            false,
        );

        const asyncSearch = {{ $name }}List.closest('.choices').querySelector('input[type=search]');

        asyncSearch.addEventListener(
            'input',
            debounce(event => choices{{ $name }}.setChoices(async () => {
                try {
                    const query = asyncSearch.value ?? null
                    const response = await axios.post('{{ route($route) }}', {
                        query: query,
                        depended: dependData
                    });
                    {{--choices{{ $name }}.setChoices(response.data.result, 'value', 'label', true)--}}
                    setTimeout(() => {
                        asyncSearch.focus();
                    }, 0);
                    return response.data.result;
                } catch (err) {
                    @if(!app()->isProduction())
                    console.log(err);
                    @endif
                }
            }, 'value', 'label', true), 700),
            false
        )

        @if($showOld)
            let select{{ $name }} = document.querySelector(`[name="{{ $selectName }}"]`);

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
