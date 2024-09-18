{{--@props([--}}
{{--    'name',--}}
{{--    'selectName',--}}
{{--    'dependOn',--}}
{{--    'dependField',--}}
{{--    'route',--}}
{{--    'options' => false,--}}
{{--    'label' => false,--}}
{{--    'defaultOption' => false,--}}
{{--    'selected' => false,--}}
{{--    'arrayKey' => false,--}}
{{--    'key' => 'id',--}}
{{--    'optionName' => 'name',--}}
{{--    'required' => false,--}}
{{--    'showOld' => true--}}
{{--])--}}

<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    :required="$required"
    :name="$selectName"
    :label="$label">

    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    @foreach($options as $option)
        <x-ui.form.option
            :value="$option[$key]"
            :selected="$isSelected($option[$key])">
                {{ $option[$optionName] }}
        </x-ui.form.option>
    @endforeach

{{--    @if(old($filteredName) && $showOld)--}}
{{--        <x-ui.form.option :value="old($filteredName)" selected>--}}
{{--            waesdf--}}
{{--        </x-ui.form.option>--}}
{{--    @endif--}}

</x-libraries.choices>

@push('scripts')
    <script type="module">
        const {{ $name }} = document.querySelector('.choices-{{ $name }}');
        const choices{{ $name }} = new Choices({{ $name }}, {
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            noResultsText: '{{ __('common.not_found') }}',
            noChoicesText: '{{ __('common.nothing_else') }}',
        });

        const {{ $name }}Depended = document.querySelector("[name='{{ $dependOn }}']");

        const dependData = {};

        choices{{ $name }}.disable();

        async function setChoices() {
            try {
                const response = await axios.post('{{ route($route) }}', {
                    all: true,
                    depended: dependData
                });
                {{--choices{{ $name }}.setChoices(response.data.result, 'value', 'label', true)--}}
                setTimeout(() => {

                }, 0);
                return response.data.result;
            } catch (err) {
                @if(!app()->isProduction())
                    console.log(err);
                @endif
            }
        }

        {{ $name }}Depended.addEventListener(
            'addItem',
            function(event) {
                if({{ $name }}Depended.value) {
                    console.log('add');
                    choices{{ $name }}.enable();
                    dependData['{{ $dependField }}'] = event.detail.value

                    choices{{ $name }}.setChoices(async () => {
                        return setChoices()
                    })

                    {{--choices{{ $name }}.setChoiceByValue('waesdf')--}}
                }
            },
            false,
        );

        {{ $name }}Depended.addEventListener(
            'removeItem',
            function(event) {
                console.log ('remove');
                choices{{ $name }}.disable();
                choices{{ $name }}.setChoiceByValue(['']);
                choices{{ $name }}.clearChoices();
                delete dependData['{{ $dependField }}'];
            },
            false,
        );

        @if(old($dependOn) && $showOld)
            choices{{ $name }}.enable();
            dependData['{{ $dependField }}'] = {{ $name }}Depended.value;

            choices{{ $name }}.setChoices(async () => {
                return setChoices().then(() => console.log(choices{{ $name }}.getValue(true)))
            })

            @if(old($filteredName))

        {{--window.addEventListener("load", function(){--}}
        {{--        console.log(choices{{ $name }}.getValue());--}}
        {{--});--}}

            @endif
        @endif

    </script>
@endpush
