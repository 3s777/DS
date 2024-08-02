@props([
    'name',
    'options',
    'placeholder' => false,
    'defaultOption' => false,
    'arrayKey' => false,
    'selected' => false
])

<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    :name="$arrayKey ? $arrayKey.'['.$name.'][]' : $name.'[]'"
    :error="$name"
    :label="$placeholder"
    multiple>
    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    @if($selected)
        @foreach($options as $option)
            <x-ui.form.option
                value="{{ $option['id'] }}"
                :selected="old()
                    ? in_array($option['id'], old($arrayKey.'.'.$name, [])) || in_array($option['id'], old($name, []))
                    : $selected->contains('id', $option['id'])">
                {{ $option['name'] }}
            </x-ui.form.option>
        @endforeach
    @else
        @foreach($options as $option)
            <x-ui.form.option
                value="{{ $option['id'] }}"
                :selected="$arrayKey
                    ? in_array($option['id'], old($arrayKey.'.'.$name, []))
                    : in_array($option['id'], old($name, []))">
                {{ $option['name'] }}
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
