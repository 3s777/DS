@props([
    'name',
    'route',
    'label' => false,
    'selected' => false,
    'selectName' => false,
    'showOld' => true,
    'defaultOption' => false,
    'error' => false,
    'dependedOn' => false,
    'dependedField' => false,
    'field' => 'user_id'
])

<x-libraries.choices
    {{ $attributes->class([
        $name.'-select' => $name
    ]) }}
    id="{{ $name }}-select"
    :name="$selectName ?: $name.'_id'"
    :error="$error"

    :label="$label">

    @if($defaultOption && !$selected)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    @if($selected)
        <x-ui.form.option :value="$selected->id" :selected="!old('{{ $name }}_id')">
            {{ $selected->name }}
        </x-ui.form.option>
    @endif

    @if(old($name.'_id') && $showOld)
        <x-ui.form.option :value="old($name.'_id')" selected>
            {{ old('old_selected_'.$name.'_label') }}
        </x-ui.form.option>
    @endif

    @if(old($selectName) && $showOld)
        <x-ui.form.option :value="old($selectName)" selected>
            {{ old('old_selected_'.$name.'_label') }}
        </x-ui.form.option>
    @endif

</x-libraries.choices>

@if($showOld)
    @if($selected)
        <input type="hidden" name="old_selected_{{ $name }}_label" value="{{ $selected->name }}" id="old_selected_{{ $name }}_label">
    @else
        <input type="hidden" name="old_selected_{{ $name }}_label" value="{{ old('old_selected_'.$name.'_label') }}" id="old_selected_{{ $name }}_label">
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

        {{--asyncSelect.searchTerms.addEventListener(--}}
        {{--    'input',--}}
        {{--    event => choices{{ $name }}.clearStore(),--}}
        {{--    false,--}}
        {{--)--}}

        @if($dependedOn)
            const {{ $name }}Depended = document.querySelector('.{{ $dependedOn }}-select');

            const dependedData = {};

            choices{{ $name }}.disable();

            {{ $name }}Depended.addEventListener(
                'addItem',
                function(event) {
                    choices{{ $name }}.enable();
{{--                    {{ $name }}List.setAttribute('data-depended', '{{ $dependedField }},'+event.detail.value);--}}
                    dependedData['{{ $dependedField }}'] = event.detail.value
                    // do something creative here...
                    // console.log(event.detail.id);
                    // console.log(event.detail.value);
                    // console.log(event.detail.label);
                    // console.log(event.detail.customProperties);
                    // console.log(event.detail.groupValue);
                },
                false,
            );


        {{ $name }}Depended.addEventListener(
            'removeItem',
            function(event) {
                choices{{ $name }}.disable();
                choices{{ $name }}.setChoiceByValue(['']);
            },
            false,
        );
        @endif

        asyncSelect.searchTerms.addEventListener(
            'input',
            debounce(event => asyncSelect.asyncSearch(choices{{ $name }} @if($dependedOn) ,dependedData @endif), 300),
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
