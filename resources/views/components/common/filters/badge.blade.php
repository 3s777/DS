<x-ui.badge
        class="filter-badge"
        type="tag"
        color="dark">

    <div class="filter-badge__title">{{ $filter->title() }}:</div>

    @if(is_array($filter->preparedValues()))
        @foreach($filter->preparedValues() as $key => $value)
            <div class="filter-badge__item">
                <div class="filter-badge__value">{{ $value }}</div>
                <div class="filter-badge__delete">
                    <a href="{{ request()->fullUrlWithoutQuery(['filters.'.$filter->key().'.'.$key]) }}">
                        <x-svg.close></x-svg.close>
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <div class="filter-badge__item">
            <div class="filter-badge__value">{{ $filter->preparedValues() }}</div>
            <div class="filter-badge__delete">
                <a href="{{ request()->fullUrlWithoutQuery(['filters.'.$filter->key()]) }}">
                    <x-svg.close></x-svg.close>
                </a>
            </div>
        </div>
    @endif
</x-ui.badge>
