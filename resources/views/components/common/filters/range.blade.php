@props([
    'name',
    'filter' => $filter ?? get_filter($name),
    'placeholder' => $filter->placeholder()
])

<div class="filter-range">
    <div class="filter-range__label">{{ $placeholder }}</div>
    <div class="filter-range__inner">
        <x-ui.form.input-text
            class="filter-range__field"
            :placeholder="__('common.from')"
            :id="$name"
            :value="request('filters.'.$name.'.from')"
            name='filters[{{ $name }}][from]'
            autocomplete="on">
        </x-ui.form.input-text>
        -
        <x-ui.form.input-text
            class="filter-range__field"
            :placeholder="__('common.to')"
            :id="$name"
            :value="request('filters.'.$name.'.to')"
            name='filters[{{ $name }}][to]'
            autocomplete="on">
        </x-ui.form.input-text>
    </div>
</div>

