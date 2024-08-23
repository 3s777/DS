@props([
    'name',
    'options',
    'placeholder' => false,
    'defaultOption' => false,
    'selected' => false,
    'arrayKey' => false,
    'key' => 'id',
    'optionName' => 'name',
    'required' => false,
    'type' => false
])

<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    :required="$required"
    :name="$arrayKey ? $arrayKey.'['.$name.']' : $name"
    :error="$name"
    :label="$placeholder">

    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    @if($type === 'enum')
            @if($selected)
                @foreach($options as $option)
                    <x-ui.form.option
                        value="{{ $option->$key }}"
                        :selected="old()
                    ? $option->$key == old($arrayKey.'.'.$name) || $option->$key == old($name)
                    : $option->$key == $selected">
                        {{ $option->$optionName }}
                    </x-ui.form.option>
                @endforeach
            @else
                @foreach($options as $option)
                    <x-ui.form.option
                        value="{{ $option->$key }}"
                        :selected="$arrayKey
                    ? $option->$key == old($arrayKey.'.'.$name)
                    : $option->$key == old($name)">
                        {{ $option->$optionName }}
                    </x-ui.form.option>
                @endforeach
            @endif
    @else
        @if($selected)
            @foreach($options as $option)
                <x-ui.form.option
                    value="{{ $option[$key] }}"
                    :selected="old()
                ? $option[$key] == old($arrayKey.'.'.$name) || $option[$key] == old($name)
                : $option[$key] == $selected">
                    {{ $option[$optionName] }}
                </x-ui.form.option>
            @endforeach
        @else
            @foreach($options as $option)
                <x-ui.form.option
                    value="{{ $option[$key] }}"
                    :selected="$arrayKey
                ? $option[$key] == old($arrayKey.'.'.$name)
                : $option[$key] == old($name)">
                    {{ $option[$optionName] }}
                </x-ui.form.option>
            @endforeach
        @endif
    @endif
</x-libraries.choices>

@push('scripts')
    <script type="module">
        const {{ $name }} = document.querySelector('.choices-{{ $name }}');
        new Choices({{ $name }}, {
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            noResultsText: '{{ __('common.not_found') }}',
            noChoicesText: '{{ __('common.nothing_else') }}',
        });
    </script>
@endpush
