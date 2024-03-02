<x-ui.badge
        class="current-filters__badge"
        type="tag"
        color="dark">

        {{ $filter->title() }}: {{ $filter->preparedValues() }}

        <div class="current-filters__delete">
            <a href="{{ request()->fullUrlWithoutQuery(['filters.'.$filter->key()]) }}">
                <x-svg.close></x-svg.close>
            </a>
        </div>
</x-ui.badge>

