<x-layouts.main title="{{ __('user.profile.info') }}">
    <x-grid.container>
        <x-common.content class="profile">
            <x-slot:sidebar>
                @include('content.profile.menu')
            </x-slot:sidebar>
            <x-ui.title indent="normal">{{ __('user.profile.info') }}</x-ui.title>

            <x-common.messages class="profile__messages" />

                <div class="profile__main">
                    <div class="profile__info">
                    @if(auth('collector')->user()->getFeaturedImagePath())
                        <div class="profile__avatar">
                            <x-ui.responsive-image
                                class="profile__avatar-img"
                                :model="auth('collector')->user()"
                                :image-sizes="['extra_small', 'small']"
                                :path="auth('collector')->user()->getFeaturedImagePath()"
                                :placeholder="false"
                                sizes="(max-width: 768px) 100px, (max-width: 1400px) 80px, 100px">
                                <x-slot:img alt="test" title="test title"></x-slot:img>
                            </x-ui.responsive-image>
                        </div>
                    @endif


                        <div class="profile__info-title">
                            <div class="profile__name" title="{{ auth('collector')->user()->first_name }}">
                                {{ auth('collector')->user()->first_name }}
                            </div>

                            <x-ui.tag color="success" class="profile__username"
                                      @click="$clipboard('{{ '@'.auth('collector')->user()->name }}');">
                                {{ '@'.auth('collector')->user()->name }}
                            </x-ui.tag>
                        </div>
                    </div>

                    <div class="profile__summary">
                        <div class="profile__summary-item">
                            <a href="/" class="profile__summary-inner">
                                <div class="profile__summary-title">{{ trans_choice('shelf.shelves', 2) }}</div>
                                <div class="profile__summary-value" title="125">{{ $collector->shelves_count }}</div>
                            </a>
                        </div>

                        <div class="profile__summary-item">
                            <a href="/" class="profile__summary-inner">
                                <div class="profile__summary-title">{{ __('shelf.on') }}</div>
                                <div class="profile__summary-value" title="253652">{{ $collector->collectibles_count }}</div>
                            </a>
                        </div>

                        <div class="profile__summary-item">
                            <a href="/" class="profile__summary-inner">
                                <div class="profile__summary-title">{{ __('common.favorite') }}</div>
                                <div class="profile__summary-value" title="253654">2536542222</div>
                            </a>
                        </div>

                        <div class="profile__summary-item">
                            <a href="/" class="profile__summary-inner">
                                <div class="profile__summary-title">{{ __('common.wishful') }}</div>
                                <div class="profile__summary-value" title="9">253654</div>
                            </a>
                        </div>
                    </div>

                    <div class="profile__rating">
                        <x-content.rating
                            class="profile__rating-inner"
                            rating="9"/>
                    </div>


                </div>

        </x-common.content>
    </x-grid.container>

    <x-ui.toast ::class="$store.toastHide ? '' : 'toast_show'" >
        <x-ui.message
            type="info"
            close="true">
            {{ __('user.username_copied') }}
            <x-slot:close x-on:click="$store.toastHide = true">
            </x-slot:close>
        </x-ui.message>
    </x-ui.toast>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('toastHide', true);
                Alpine.magic('clipboard', () => {
                    return subject => navigator.clipboard.writeText(subject).then(() => {
                        Alpine.store('toastHide', false);

                        setTimeout(() => {
                            Alpine.store('toastHide', true);
                        }, 3000);
                    })
                        .catch(err => {
                            console.error('Error: ', err);
                        })
                });
            });
        </script>
    @endpush
</x-layouts.main>
