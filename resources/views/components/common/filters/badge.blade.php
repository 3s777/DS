<x-ui.badge
    class="current-filters__badge"
    type="tag"
    color="dark">

    {{ $filter->title() }}: {{ $values }}

{{--    @foreach($filter->values() as $value)--}}
{{--        {{ $value }}--}}
{{--    @endforeach--}}
    <div class="current-filters__delete">
        <x-svg.close></x-svg.close>
    </div>
</x-ui.badge>
