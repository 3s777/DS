@props([
    'name',
    'selectName',
    'options',
    'placeholder' => false,
    'defaultOption' => false,
    'arrayKey' => false,
    'selected' => false,
    'key' => 'id',
    'optionName' => 'name'
])

<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    :name="$arrayKey ? $arrayKey.'['.$name.'][]' : $name.'[]'"
    :label="$placeholder"
    :error="$name"
    multiple>
    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    {{ $slot }}

    @if($selected)
        @foreach($options as $option)
            @if(is_array($selected))
                <x-ui.form.option
                    value="{{ $option[$key] }}"
                    :selected="old()
                    ? in_array($option[$key], old($arrayKey.'.'.$name, [])) || in_array($option[$key], old($name, []))
                    : in_array($option[$key], $selected)">
                    {{ $option[$optionName] }}
                </x-ui.form.option>
            @else
                <x-ui.form.option
                    value="{{ $option[$key] }}"
                    :selected="old()
                    ? in_array($option[$key], old($arrayKey.'.'.$name, [])) || in_array($option[$key], old($name, []))
                    : $selected->contains($key, $option[$key])">
                    {{ $option[$optionName] }}
                </x-ui.form.option>
            @endif
        @endforeach
    @else
        @foreach($options as $option)
            <x-ui.form.option
                value="{{ $option[$key] }}"
                :selected="$arrayKey
                    ? in_array($option[$key], old($arrayKey.'.'.$name, []))
                    : in_array($option[$key], old($name, []))">
                {{ $option[$optionName] }}
            </x-ui.form.option>
        @endforeach
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
