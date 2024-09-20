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
        const {{ $name }} = document.querySelector('.choices-{{ $name }}');
        const choices{{ $name }} = new Choices({{ $name }}, {
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            loadingText: '{{ __('common.loading') }}',
            noResultsText: '{{ __('common.not_found') }}',
            noChoicesText: '{{ __('common.nothing_else') }}',
        });

        const {{ $name }}Depended = document.querySelector("[name='{{ $dependOn }}']");

        const dependData = {};

        choices{{ $name }}.disable();

        async function setData() {
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
                    choices{{ $name }}.clearChoices();
                    choices{{ $name }}.setChoices(async () => {
                        return setData()
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

        if({{ $name }}Depended.value !== '') {
            choices{{ $name }}.enable();
            dependData['{{ $dependField }}'] = {{ $name }}Depended.value;

            @if(old($dependOn) && $showOld)
                choices{{ $name }}.setChoices(async () => {
                    return setData()
                }).then(() => choices{{ $name }}.setChoiceByValue({{ old($filteredName) }}))
            @else
                choices{{ $name }}.setChoices(async () => {
                    return setData()
                })@if($selected).then(() => choices{{ $name }}.setChoiceByValue({{ $selected }}))@endif
            @endif
        }
    </script>
@endpush
