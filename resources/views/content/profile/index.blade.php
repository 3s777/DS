<x-layouts.main title="{{ __('user.profile.info') }}" :search="false">
    <x-grid.container>
        <x-common.content class="profile">
            <x-slot:sidebar>
                @include('content.profile.menu')
            </x-slot:sidebar>
            <x-ui.title indent="normal">{{ __('user.profile.info') }}</x-ui.title>

            <x-common.messages class="profile__messages" />

                <div class="profile__main">
                    <div class="profile__avatar">
                        <x-ui.responsive-image
                            :model="auth('collector')->user()"
                            :image-sizes="['extra_small', 'small']"
                            :path="auth('collector')->user()->getFeaturedImagePath()"
                            :placeholder="false"
                            sizes="(max-width: 1024px) 100vw, (max-width: 1400px) 30vw, 100px">
                            <x-slot:img alt="test" title="test title"></x-slot:img>
                        </x-ui.responsive-image>
                    </div>

                    <div class="profile__info">
                        <div class="profile__info-title">
                            <div class="profile__name">
                                {{ auth('collector')->user()->first_name }}
                            </div>

                            <x-ui.tag color="success" class="profile__username">
                                {{ '@'.auth('collector')->user()->name }}
                            </x-ui.tag>
                        </div>



                    <div class="profile__statistic">

                    </div>

                    <div class="profile__rating">
                        <x-content.rating
                            class="profile__rating-inner"
                            rating="9"/>
                    </div>

                    </div>
                </div>

        </x-common.content>
    </x-grid.container>
</x-layouts.main>
