<x-libraries.choices
    {{ $attributes->class([
        $name.'-select' => $name
    ]) }}
    id="{{ $name }}-select"
    :name="$selectName"
    :error="$filteredName"
    :required="$required"
    :label="$label">

    @if($defaultOption && !$selected)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    {{ $slot }}

    @if(($selected && !old()) || ($selected && !$showOld))
        <x-ui.form.option :value="$selected['key']" selected>
            {{ $selected['value'] }}
        </x-ui.form.option>
    @endif

    @if(old($filteredName) && $showOld)
        <x-ui.form.option :value="old($filteredName)" selected>
            {{ old('old_selected_'.$name.'_label') }}
        </x-ui.form.option>
    @endif
</x-libraries.choices>

@if($showOld)
    @if($selected)
{{--        <input type="hidden" name="old_selected_{{ $name }}_label" value="{{ $selected[key($selected)] }}" id="old_selected_{{ $name }}_label">--}}
        <input type="hidden" name="old_selected_{{ $name }}_label" value="{{ $selected['value'] }}" id="old_selected_{{ $name }}_label">

    @else
        <input type="hidden" name="old_selected_{{ $name }}_label" value="{{ old('old_selected_'.$name.'_label') }}" id="old_selected_{{ $name }}_label">
    @endif
@endif

@if($scripts)
    @push('scripts')
        <script type="module">
            const {{ $name }}List = document.querySelector('.{{ $name }}-select');

            {{--let asyncSelect = new asyncSelectSearch('{{ route($route) }}');--}}

            const choices{{ $name }} = new Choices({{ $name }}List, {
                allowHTML: true,
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                loadingText: '{{ __('common.loading') }}',
                noResultsText: '{{ __('common.not_found') }}',
                noChoicesText: '{{ __('common.not_found') }}',
                searchPlaceholderValue: '{{ __('common.search') }}',
                {{--callbackOnInit: () => {--}}
                {{--    asyncSelect.searchTerms = {{ $name }}List.closest('.choices').querySelector('input[type=search]')--}}
                {{--},--}}
            });

            {{--asyncSelect.searchTerms.addEventListener(--}}
            {{--    'input',--}}
            {{--    event => choices{{ $name }}.clearStore(),--}}
            {{--    false,--}}
            {{--)--}}

            {{--asyncSelect.searchTerms.addEventListener(--}}
            {{--    'input',--}}
            {{--    debounce(event => asyncSelect.asyncSearch(choices{{ $name }}), 300),--}}
            {{--    false,--}}
            {{--)--}}

            const asyncSearch = {{ $name }}List.closest('.choices').querySelector('input[type=search]');

            asyncSearch.addEventListener(
                'input',
                debounce(event => choices{{ $name }}.setChoices(async () => {
                    try {
                        const query = asyncSearch.value ?? null
                        const response = await axios.post('{{ route($route) }}', {
                            query: query,
                        });
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

                let selected{{ $name }}Name = document.getElementById('old_selected_{{ $name }}_label');

                select{{ $name }}.onchange = function () {
                    if(select{{ $name }}.options[select{{ $name }}.selectedIndex]){
                        selected{{ $name }}Name.value = select{{ $name }}.options[select{{ $name }}.selectedIndex].text;
                    }
                };
            @endif
        </script>
    @endpush
@endif
