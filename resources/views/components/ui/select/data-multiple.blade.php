<x-libraries.choices
    class="choices-{{ $name }}"
    id="{{ $name }}"
    :name="$selectName"
    :label="$label"
    :error="$filteredName"
    :required="$required"
    multiple>

    @if($defaultOption)
        <x-ui.form.option value="">
            {{ $defaultOption }}
        </x-ui.form.option>
    @endif

    {{ $slot }}

    @foreach($options as $value => $option)
        <x-ui.form.option
            :value="$value"
            :selected="$isSelected($value)">
            {{ $option }}
        </x-ui.form.option>
            <script>
                console.log('{{ $isSelected($value) }}');
            </script>
    @endforeach

{{--    @foreach($options as $option)--}}
{{--        <x-ui.form.option--}}
{{--            :value="$option[$key]"--}}
{{--            :selected="$isSelected($option[$key])">--}}
{{--            {{ $option[$optionName] }}--}}
{{--        </x-ui.form.option>--}}
{{--    @endforeach--}}

{{--    @if($selected)--}}
{{--        @foreach($options as $option)--}}
{{--            @if(is_array($selected))--}}
{{--                <x-ui.form.option--}}
{{--                    value="{{ $option[$key] }}"--}}
{{--                    :selected="old()--}}
{{--                    ? in_array($option[$key], old($name, []))--}}
{{--                    : in_array($option[$key], $selected)">--}}
{{--                    {{ $option[$optionName] }}--}}
{{--                </x-ui.form.option>--}}
{{--            @else--}}
{{--                <x-ui.form.option--}}
{{--                    value="{{ $option[$key] }}"--}}
{{--                    :selected="old()--}}
{{--                    ? in_array($option[$key], old($name, []))--}}
{{--                    : $selected->contains($key, $option[$key])">--}}
{{--                    {{ $option[$optionName] }}--}}
{{--                </x-ui.form.option>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    @else--}}
{{--        @foreach($options as $option)--}}
{{--            <x-ui.form.option--}}
{{--                value="{{ $option[$key] }}"--}}
{{--                :selected="$arrayKey--}}
{{--                    ? in_array($option[$key], old($arrayKey.'.'.$name, []))--}}
{{--                    : in_array($option[$key], old($name, []))">--}}
{{--                {{ $option[$optionName] }}--}}
{{--            </x-ui.form.option>--}}
{{--        @endforeach--}}
{{--    @endif--}}
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
