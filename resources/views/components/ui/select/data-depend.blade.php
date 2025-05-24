<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    :required="$required"
    :name="$selectName"
    :label="$label"
    :error="$filteredName">

    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    {{ $slot }}

    @foreach($options as $value => $option)
        <x-ui.form.option
            :value="$value"
{{--            :selected="$isSelected($value)"--}}
        >
            {{ $option }}
        </x-ui.form.option>
    @endforeach
</x-libraries.choices>

@if($scripts)
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

            if({{ $name }}Depended.value !== '') {
                choices{{ $name }}.enable();
                dependData['{{ $dependField }}'] = {{ $name }}Depended.value;

                let selectedChoices = choices{{ $name }}.setChoices(async () => {
                    return setData()
                });

                @if($selected)
                    selectedChoices.then(() => choices{{ $name }}.setChoiceByValue({{ $selected }}))
                @endif

                @if(old($filteredDependName) && $showOld)
                    selectedChoices.then(function() {
                        choices{{ $name }}.setChoiceByValue({{ old($filteredName) }});
                        let event = new Event("loaded-old-depended", {bubbles: true});
                        {{ $name }}.dispatchEvent(event);
                    }
                )
                @endif
            }

            choices{{ $name }}.disable();

            async function setData() {
                try {
                    const response = await axios.post('{{ route($route) }}', {
                        all: true,
                        depended: dependData
                    });
                    console.log(response.data.result);
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
                        choices{{ $name }}.setChoiceByValue(['']);
                        choices{{ $name }}.clearChoices();
                        {{--choices{{ $name }}.clearStore();--}}
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
        </script>
    @endpush
@endif
