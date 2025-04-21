<x-layouts.main title="{{ __('Users') }}">
    <x-grid.container>
        <x-common.content class="rules" :collapsable="false">
            <x-slot:sidebar>
                @include('content.rules.menu')
            </x-slot:sidebar>
                <x-ui.title size="normal" indent="big">{{ $page->name }}</x-ui.title>
                <div class="content__main content__main_article">
                    {!! $page->description !!}
                </div>
        </x-common.content>
    </x-grid.container>

    @push('scripts')
    @endpush
</x-layouts.main>
