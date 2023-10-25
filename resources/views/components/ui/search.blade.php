@props([
    'link' => '#',
    'placeholder',
    'id_input' => '',
    'id_form' => '',
    'color'=>''
])

<div class="search" x-data="{ search_active: false }">
    <div class="search__inner" x-on:click.outside="search_active = false">
        <form
            {{ $attributes->class([
                'search__form',
                'search__form_color_'.$color => $color
                ])
            }}
            :class="search_active ? 'search__form_active' : ''"
            action="{{ $link }}">
            <input
                id="{{ $id_input }}"
                x-on:click="search_active = true"
                class="search__form-input"
                type="search"
                placeholder="{{ $placeholder }}">
            <button class="search__form-button">
                <x-svg.search class="search__icon"></x-svg.search>
            </button>
        </form>
    </div>
</div>
