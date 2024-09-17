@props([
    'name',
    'options',
    'dependOn',
    'dependField',
    'route',
    'placeholder' => false,
    'defaultOption' => false,
    'selected' => false,
    'arrayKey' => false,
    'key' => 'id',
    'optionName' => 'name',
    'required' => false
])

<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    :required="$required"
    :name="$arrayKey ? $arrayKey.'['.$name.']' : $name"
    :label="$placeholder">

    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    @if($selected)
        @foreach($options as $option)
            <x-ui.form.option
                :value="$option[$key]"
                :selected="old()
                    ? $option[$key] == old($arrayKey.'.'.$name) || $option[$key] == old($name)
                    : $option[$key] == $selected">
                {{ $option[$optionName] }}
            </x-ui.form.option>
        @endforeach
    @else
        @foreach($options as $option)
            <x-ui.form.option
                :value="$option[$key]"
                :selected="$arrayKey
                    ? $option[$key] == old($arrayKey.'.'.$name)
                    : $option[$key] == old($name)">
                {{ $option[$optionName] }}
            </x-ui.form.option>
        @endforeach
    @endif

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



        {{ $name }}Depended.addEventListener(
            'addItem',
            function(event) {
                if({{ $name }}Depended.value) {
                    console.log('add');
                    choices{{ $name }}.enable();
                    dependData['{{ $dependField }}'] = event.detail.value

                    choices{{ $name }}.setChoices(async () => {
                        try {

                            const response = await axios.post('{{ route($route) }}', {
                                // query: query,
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
                    })
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

    </script>
@endpush
