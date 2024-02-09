@props([
    'placeholder',
    'name' => 'filters[search]',
    'idInput' => 'search',
    'color'=>'',
    'wrapperClass'=>false,
    'sortable' => false,
    'method' => 'post'
])

<div class="input-search @if($wrapperClass) {{ $wrapperClass }} @endif" x-data="{ search_active: false }">
    <div class="input-search__inner" x-on:click.outside="search_active = false">
        <form
            {{ $attributes->class([
                'input-search__form',
                'input-search__form_color_'.$color => $color
                ])
            }}
            :class="search_active ? 'input-search__form_active' : ''"
            method="{{ $method }}">

            @if($method === 'post')
                @csrf
            @endif

            @if($sortable)
                <input name="sort" type="hidden" value="{{ request('sort') }}">
                <input name="order" type="hidden" value="{{ request('order') }}">
            @endif

            <input
                name="{{ $name }}"
                id="{{ $idInput }}"
                x-on:click="search_active = true"
                class="input-search__form-input"
                type="search"
                placeholder="{{ $placeholder }}"
                value="{{ request('filters.search') }}">

            {{ $slot }}

            <button class="input-search__form-button">
                <x-svg.search class="input-search__icon"></x-svg.search>
            </button>
        </form>
    </div>
</div>
