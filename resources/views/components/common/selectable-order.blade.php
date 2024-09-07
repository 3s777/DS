@props([
    'sorters',
    'name' => 'selectable-order__choices',
    'mobile' => true,
])

<div
    {{ $attributes->class([
        'selectable-order',
        'selectable-order_mobile' => $mobile
        ])
    }}
     x-data="{selectableOrder: '{{ filter_url(['sort' => request('sort'), 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}'}">
    <x-libraries.choices
        x-model="selectableOrder"
        x-on:change="window.location = selectableOrder.value"
        class="{{ $name }}"
        id="{{ $name }}"
        name="{{ $name }}"
        label="{{ __('common.sort') }}">
        <x-ui.form.option value="">{{ __('common.sort_by') }}</x-ui.form.option>
        @foreach($sorters as $key => $value)
            <option
                value="{{ filter_url(['sort' => $key, 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
                {{ $value }}
            </option>
        @endforeach
    </x-libraries.choices>

    @if(request('sort'))
        <x-ui.form.button
            class="selectable-order__button"
            color="dark"
            tag="a"
            href="{{ filter_url(['sort' => request('sort'), 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
            <div class="selectable-order__arrow
                @if(request('order') == 'asc' && request('sort') == request('sort'))
                    selectable-order__arrow_active
                @endif">
            </div>
            <div class="selectable-order__arrow selectable-order__arrow_desc
                @if(request('order') == 'desc' && request('sort') == request('sort'))
                    selectable-order__arrow_active
                @endif">
            </div>
        </x-ui.form.button>
    @endif
</div>

@push('scripts')
    <script type="module">
        const selectableOrderElement = document.querySelector('.{{ $name }}');
        const selectableOrderChoices = new Choices(selectableOrderElement, {
            itemSelectText: '',
            searchEnabled: false,
        });
    </script>
@endpush
