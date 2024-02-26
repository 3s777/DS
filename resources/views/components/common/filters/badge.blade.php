@if($filter->requestValue())
    <x-ui.badge
        class="current-filters__badge"
        type="tag"
        color="dark">

        {{ $filter->title() }}: {{ $filter->preparedValues() }}

        <div class="current-filters__delete">
            <x-svg.close></x-svg.close>
        </div>
    </x-ui.badge>
@endif
