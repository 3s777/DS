@props([
    'link' => '#',
    'placeholder',
    'id_input' => '',
    'id_form' => '',
    'color'=>'',
    'wrapper_class'=>false
])

<div class="input-search @if($wrapper_class) {{ $wrapper_class }} @endif" x-data="{ search_active: false }">
    <div class="input-search__inner" x-on:click.outside="search_active = false">
        <form
            {{ $attributes->class([
                'input-search__form',
                'input-search__form_color_'.$color => $color
                ])
            }}
            :class="search_active ? 'input-search__form_active' : ''"
            action="{{ $link }}">
            <input
                id="{{ $id_input }}"
                x-on:click="search_active = true"
                class="input-search__form-input"
                type="search"
                placeholder="{{ $placeholder }}">
            <button class="input-search__form-button">
                <x-svg.search class="input-search__icon"></x-svg.search>
            </button>
        </form>
    </div>
</div>
