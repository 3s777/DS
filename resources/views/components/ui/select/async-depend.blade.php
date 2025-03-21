<x-libraries.choices
    {{ $attributes->class([
        $name.'-select' => $name
    ]) }}
    id="{{ $name }}-select"
    :error="$filteredName"
    :name="$selectName"
    :label="$label"
    :required="$required">

    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

{{--    @if(($selected && !old()) || ($selected && !$showOld))--}}
{{--        <x-ui.form.option :value="key($selected)">--}}
{{--            {{ $selected[key($selected)] }}--}}
{{--        </x-ui.form.option>--}}
{{--    @endif--}}

{{--    @if(old($filteredName) && $showOld)--}}
{{--        <x-ui.form.option :value="old($filteredName)" selected>--}}
{{--            {{ old('old_selected_'.$name.'_label') }}--}}
{{--        </x-ui.form.option>--}}
{{--    @endif--}}
</x-libraries.choices>

@if($showOld)
    @if($selected)
        <input type="hidden" name="old_selected_{{ $name }}_label" value="{{ $selected['value'] }}" id="old_selected_{{ $name }}_label">
    @else
        <input type="hidden" name="old_selected_{{ $name }}_label" value="{{ old('old_selected_'.$name.'_label') }}" id="old_selected_{{ $name }}_label">
    @endif
@endif

@if($scripts)
    @push('scripts')
        <script type="module">
            const {{ $name }}List = document.querySelector('.{{ $name }}-select');

            const choices{{ $name }} = new Choices({{ $name }}List, {
                allowHTML: true,
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                loadingText: '{{ __('common.loading') }}',
                noResultsText: '{{ __('common.not_found') }}',
                noChoicesText: '{{ __('common.not_found') }}',
                searchPlaceholderValue: '{{ __('common.search') }}',
            });

            const {{ $name }}Depended = document.querySelector("[name='{{ $dependOn }}']");

            const dependData = {};

            choices{{ $name }}.disable();

            if({{ $name }}Depended.value !== '') {
                choices{{ $name }}.enable();
                dependData['{{ $dependField }}'] = {{ $name }}Depended.value;


                @if(($selected && !old()) || ($selected && !$showOld))
                    choices{{ $name }}.setValue([
                        { value: '{{ $selected['key'] }}', label: '{{ $selected['value'] }}', selected: true }
                    ]);
                @endif

                @if((old($filteredName) && $showOld) || (old($filteredDependName) && $showOld))
                    choices{{ $name }}.setValue([
                        { value: '{{ old($filteredName) }}', label: '{{ old('old_selected_'.$name.'_label') }}', selected: true }
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
                    choices{{ $name }}.setChoiceByValue(['']);
                    choices{{ $name }}.clearChoices();
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

            //  Переключатель на код загрузки choices без асинхронной загрузки. При этом не работает поле Загрузка
            {{--asyncSearch.addEventListener(--}}
            {{--    'input',--}}
            {{--    debounce(async function () {--}}
            {{--        try {--}}
            {{--            const query = asyncSearch.value ?? null--}}
            {{--            const response = await axios.post('{{ route($route) }}', {--}}
            {{--                query: query,--}}
            {{--                depended: dependData--}}
            {{--            });--}}
            {{--            choices{{ $name }}.setChoices(response.data.result, 'value', 'label', true)--}}
            {{--        } catch (err) {--}}
            {{--            console.error(err);--}}
            {{--        }--}}
            {{--    }, 300),--}}
            {{--    false,--}}
            {{--)--}}

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
