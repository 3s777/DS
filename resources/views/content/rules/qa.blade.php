<x-layouts.main title="{{ __('Users') }}">
    <x-grid.container>
        <x-common.content class="rules" :collapsable="false">
            <x-slot:sidebar>
                @include('content.rules.menu')
            </x-slot:sidebar>
                <x-ui.title size="normal" indent="big">{{ __('common.qa') }}</x-ui.title>
                <div class="content__main content__main_article">
                    <x-ui.accordion>
                        @foreach($qas as $qa)
                            <x-ui.accordion.item>
                            <x-ui.accordion.title>{{ $qa->name }}</x-ui.accordion.title>
                            <x-ui.accordion.content>
                                {!! $qa->description !!}
                            </x-ui.accordion.content>
                        </x-ui.accordion.item>
                        @endforeach
                    </x-ui.accordion>
                </div>
        </x-common.content>
    </x-grid.container>

    @push('scripts')
    @endpush
</x-layouts.main>
