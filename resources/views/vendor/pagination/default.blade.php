@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="{{ __('pagination.navigation') }}">
        <div class="pagination__pages">
            @if ($paginator->onFirstPage())
                <x-ui.form.button
                    tag="span"
                    color="disabled"
                    only-icon="true"
                    size="small"
                    aria-disabled="true"
                    aria-label="{{ __('pagination.previous') }}"
                    title="{{ __('pagination.previous') }}">
                    <x-slot:icon class="button__icon-wrapper_prev">
                        <x-svg.prev class="button__icon button__icon_small" />
                    </x-slot:icon>
                </x-ui.form.button>
            @else
                <x-ui.form.button
                    tag="a"
                    link="{!! $paginator->previousPageUrl() !!}"
                    color="submit"
                    only-icon="true"
                    size="small"
                    aria-disabled="true"
                    rel="prev"
                    aria-label="{{ __('pagination.previous') }}"
                    title="{{ __('pagination.previous') }}">
                    <x-slot:icon class="button__icon-wrapper_prev">
                        <x-svg.prev class="button__icon button__icon_small" />
                    </x-slot:icon>
                </x-ui.form.button>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="pagination__dots" aria-disabled="true">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <x-ui.form.button
                                class="pagination__pages-num"
                                tag="span"
                                color="disabled"
                                size="small"
                                aria-current="page">
                                {{ $page }}
                            </x-ui.form.button>
                        @else
                            <x-ui.form.button
                                class="pagination__pages-num"
                                tag="a"
                                link="{!! $url !!}"
                                color="submit"
                                size="small"
                                aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                                title="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </x-ui.form.button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <x-ui.form.button
                    tag="a"
                    link="{!! $paginator->nextPageUrl() !!}"
                    color="submit"
                    only-icon="true"
                    size="small"
                    aria-disabled="true"
                    rel="next"
                    aria-label="{{ __('pagination.next') }}"
                    title="{{ __('pagination.next') }}">
                    <x-slot:icon class="button__icon-wrapper_next">
                        <x-svg.next class="button__icon button__icon_small" />
                    </x-slot:icon>
                </x-ui.form.button>
            @else
                <x-ui.form.button
                    tag="span"
                    color="disabled"
                    only-icon="true"
                    size="small"
                    aria-disabled="true"
                    aria-label="{{ __('pagination.next') }}"
                    title="{{ __('pagination.next') }}">
                    <x-slot:icon class="button__icon-wrapper_next">
                        <x-svg.next class="button__icon button__icon_small" />
                    </x-slot:icon>
                </x-ui.form.button>
            @endif
        </div>

        <div class="pagination__footer">
            {!! __('pagination.showing') !!}
            @if ($paginator->firstItem())
                <span>{{ $paginator->firstItem() }}</span>
                {!! __('pagination.to') !!}
                <span>{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('pagination.of') !!}
            <span>{{ $paginator->total() }}</span>
        </div>
    </nav>
@endif
