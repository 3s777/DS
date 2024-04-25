@props([
    'name',
    'route',
    'label' => false,
    'selected' => false,
    'selectName' => false,
    'showOld' => true
])

<x-libraries.choices
    {{ $attributes->class([
        $name.'-select' => $name
    ]) }}
    id="{{ $name }}-select"
    :name="$selectName ?: $name.'_id'"
    label="{{ __('common.'.$name) }}"
>

    @if($selected)
        <x-ui.form.option value="{{ $selected->id }}" :selected="!old('{{ $name }}_id')">
            {{ $selected->name }}
        </x-ui.form.option>
    @else
        <x-ui.form.option value="">
            {{ __('common.choose_'.$name) }}
        </x-ui.form.option>
    @endif

    @if(old($name.'_id') && $showOld)
        <x-ui.form.option value="{{ old($name.'_id') }}" selected>
            {{ old('old_selected_'.$name.'_label') }}
        </x-ui.form.option>
    @endif

    {{--@foreach(${{ $name }} as ${{ $name }})--}}
    {{--    <x-ui.form.option--}}
    {{--        value="{{ ${{ $name }}['id']}}"--}}
    {{--        :selected="old('{{ $name }}_id') == ${{ $name }}['id']"--}}
    {{--    >{{ ${{ $name }}['name'] }}</x-ui.form.option>--}}
    {{--@endforeach--}}
</x-libraries.choices>

    @if($showOld)
        <input type="hidden" name="old_selected_{{ $name }}_label" value="" id="old_selected_{{ $name }}_label">
    @endif

@push('scripts')
    <script type="module">
        {{--let tee = {--}}
        {{--    searchTerms: null,--}}
        {{--    asyncUrl: '{{ route('find-{{ $name }}') }}',--}}

        {{--    fromUrl(url) {--}}
        {{--        return fetch(url)--}}
        {{--            .then(response => {--}}
        {{--                return response.json()--}}
        {{--            })--}}
        {{--            .then(json => {--}}
        {{--                return json--}}
        {{--            })--}}
        {{--    },--}}
        {{--};--}}

        // async function asyncSearch(tee) {
        //     const url = new URL(tee.asyncUrl)
        //
        //     const query = tee.searchTerms.value ?? null
        //
        //     if (query !== null && query.length) {
        //         url.searchParams.append('query', query)
        //     }
        //
        //     const options = await tee.fromUrl(url.toString())
        //
        //     choices_{{ $name }}.setChoices(options, 'value', 'label', true)
        // }

        const {{ $name }}List = document.querySelector('.{{ $name }}-select');

        let asyncSelect = new asyncSelectSearch('{{ route($route) }}');

        const choices{{ $name }} = new Choices({{ $name }}List, {
            allowHTML: true,
            itemSelectText: '',
            // removeItemButton: true,
            noResultsText: '{{ __('common.loading') }}',
            noChoicesText: '{{ __('common.not_found') }}',
            searchPlaceholderValue: 'Введите имя',
            callbackOnInit: () => {
                asyncSelect.searchTerms = {{ $name }}List.closest('.choices').querySelector('[name="search_terms"]')
                // asyncSearch(tee)
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

        // document.querySelector(`[name="{{ $name }}_id"]`).addEventListener(
        //     'change',
        //     event => {
        //         console.log(selected{{ $name }}.options[selected{{ $name }}.selectedIndex].text)
        //         selected{{ $name }}Name.value = selected{{ $name }}.options[selected{{ $name }}.selectedIndex].text;
        //     },
        //     false,
        // )

    </script>
@endpush
