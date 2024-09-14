@props([
    'name',
    'selectName',
    'route',
    'dependOn',
    'dependField',
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
    :name="$selectName"
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


            const {{ $name }}Depended = document.querySelector("[name='{{ $dependOn }}']");

            const dependData = {};

            {{--choices{{ $name }}.disable();--}}

            {{ $name }}Depended.addEventListener(
                'addItem',
                function(event) {
                    if({{ $name }}Depended.value) {
                        console.log('add');
                        choices{{ $name }}.enable();
                        dependData['{{ $dependField }}'] = event.detail.value
                    }

                },
                false,
            );


            {{ $name }}Depended.addEventListener(
                'removeItem',
                function(event) {
                    console.log ('remove');
                    {{--choices{{ $name }}.disable();--}}
                    choices{{ $name }}.setChoiceByValue(['']);
                    choices{{ $name }}.clearChoices();
                    delete dependData['{{ $dependField }}'];
                },
                false,
            );

            @if(old($selectName) && $showOld)
                choices{{ $name }}.enable();
                dependData['{{ $dependField }}'] = {{ $name }}Depended.value;
            @endif

            @if(old($dependOn) && $showOld)
                choices{{ $name }}.enable();
                dependData['{{ $dependField }}'] = {{ $name }}Depended.value;
            @endif

            {{--asyncSelect.searchTerms.addEventListener(--}}
            {{--    'input',--}}
            {{--debounce(event => asyncSelect.asyncSearch(choices{{ $name }} @if($dependOn) ,dependData @endif), 300),--}}
            {{--    false,--}}
            {{--)--}}



        async function testFill(dependData) {
            try {
                const url = new URL('{{ route($route) }}')

                const query = asyncSearch.value ?? null


                if(dependData !== null) {
                    for (const key in dependData) {
                        url.searchParams.append('depended['+key+']', dependData[key])
                    }

                }

                console.log('sdf', dependData);

                const response = await axios.post('{{ route($route) }}', {
                    query: query,
                    depended: dependData
                });

                // console.log(response.data.result);
                choices{{ $name }}.setChoices(response.data.result, 'value', 'label', true)
                console.log('dsd')
                // return response.data.result;
            } catch (err) {
                console.error(err);
            }
        }




        function handleInput(e, dependData) {




            {{--choices{{ $name }}.setChoices(async () => {--}}
            {{--});--}}

            testFill(dependData);
            // console.log('test');
            const test= document.getElementById("number");
            // console.log(test)
            // console.log(asyncSearch)
            asyncSearch.focus();
        }

        const debouncedHandle = debounce(async function () {
            try {
                const url = new URL('{{ route($route) }}')

                const query = asyncSearch.value ?? null


                if(dependData !== null) {
                    for (const key in dependData) {
                        url.searchParams.append('depended['+key+']', dependData[key])
                    }

                }

                console.log('sdf', dependData);

                const response = await axios.post('{{ route($route) }}', {
                    query: query,
                    depended: dependData
                });

                // console.log(response.data.result);
                choices{{ $name }}.setChoices(response.data.result, 'value', 'label', true)
                console.log('dsd')
                // return response.data.result;
            } catch (err) {
                console.error(err);
            }
        }, 300)

        // asyncSearch.addEventListener(
        //     'input',
        //     debouncedHandle,
        //     false,
        // )

        const asyncSearch = {{ $name }}List.closest('.choices').querySelector('input[type=search]');
        asyncSearch.addEventListener(
            'input',
            debounce(event => choices{{ $name }}.setChoices(async () => {
                try {
                    const url = new URL('{{ route($route) }}')

                    const query = asyncSearch.value ?? null

                    if(dependData !== null) {
                        for (const key in dependData) {
                            url.searchParams.append('depended['+key+']', dependData[key])
                        }

                    }

                    console.log('sdf', dependData);

                    const response = await axios.post('{{ route($route) }}', {
                        query: query,
                        depended: dependData
                    });

                    // console.log(response.data.result);
                    {{--choices{{ $name }}.setChoices(response.data.result, 'value', 'label', true)--}}
                    const test= document.getElementById("number");
                    const test2 = {{ $name }}List.closest('.choices').querySelector('input[type=search]');
                    test2.setAttribute('tabindex', '-1');
                    setTimeout(() => {
                        test2.focus();
                    }, 0);


                    return response.data.result;
                } catch (err) {
                    console.error(err);
                }
            }, 'value', 'label', true), 300),
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
