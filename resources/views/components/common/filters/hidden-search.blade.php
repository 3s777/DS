{{--<input type="hidden" id="{{ $filter->id() }}" name="{{ $filter->name() }}" x-bind:value="search">--}}
@props([
    'bindValue' => 'search'
])

<input type="hidden" id="filters_search" name="filters[search]" x-bind:value="{{ $bindValue }}">
