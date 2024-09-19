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
        <x-ui.form.option :value="$option[$key]">
                {{ $option[$optionName] }}
        </x-ui.form.option>
    @endforeach
</x-libraries.choices>

@push('scripts')
    <script type="module">
        let showOld = false;
        @if($showOld)
            showOld = true;
        @endif

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
                    choices{{ $name }}.enable();
                    dependData['{{ $dependField }}'] = event.detail.value
                    choices{{ $name }}.setChoices(async () => {
                        return setChoices()
                    })
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


{{--        @if(!old($dependOn))--}}
{{--            if({{ $name }}Depended.value !== '') {--}}
{{--                console.log('sx');--}}
{{--                choices{{ $name }}.enable();--}}
{{--                dependData['{{ $dependField }}'] = {{ $name }}Depended.value;--}}
{{--                choices{{ $name }}.setChoices(async () => {--}}
{{--                    return setChoices()--}}
{{--                })@if($selected).then(() => choices{{ $name }}.setChoiceByValue({{ $selected }}))@endif--}}
{{--            }--}}
{{--        @endif--}}

        @if(old($dependOn) && $showOld)
            choices{{ $name }}.enable();
            dependData['{{ $dependField }}'] = {{ $name }}Depended.value;

            choices{{ $name }}.setChoices(async () => {
                return setChoices()
            }).then(() => choices{{ $name }}.setChoiceByValue({{ old($filteredName) }}))

            {{--setTimeout(() => {--}}
            {{--    choices{{ $name }}.setChoiceByValue({{ old($filteredName) }});--}}
            {{--    console.log('time');--}}
            {{--}, 1000);--}}
        @endif

    </script>
@endpush
