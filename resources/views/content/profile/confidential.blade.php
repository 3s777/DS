<x-layouts.main title="{{ __('user.profile.settings_confidential') }}">
    <x-grid.container>
        <x-common.content class="profile-confidential">
            <x-slot:sidebar>
                @include('content.profile.menu')
            </x-slot:sidebar>
            <x-ui.title indent="normal">{{ __('user.profile.settings_confidential') }}</x-ui.title>

            <x-common.messages class="profile-confidential__messages" />

            <div class="profile-confidential__delete">

                <div x-data x-on:keydown.escape.window="$store.modalSingleDelete.hide = true">
                    <div x-on:click.stop="
                            $store.modalSingleDelete.hide = ! $store.modalSingleDelete.hide
                            $store.modalSingleDelete.action = '{{ route("profile.delete") }}'
                            ">
                            <x-ui.form.button
                                color="cancel"
                                class="profile-confidential__delete-button">
                                {{ __('user.profile.auth_delete') }}
                            </x-ui.form.button>
                    </div>
                </div>
            </div>
        </x-common.content>
    </x-grid.container>

    @pushonce('modals')
        <x-ui.modal x-data tag="section" ::class="$store.modalSingleDelete.hide ? '' : 'modal_show'">
            <x-ui.modal.content
                x-on:click.outside="$store.modalSingleDelete.hide = true">
                <x-ui.modal.close x-on:click="$store.modalSingleDelete.hide = true" />

                <x-ui.modal.header>
                    <x-ui.title
                        size="normal"
                        indent="normal">
                        {{ __('common.deleting') }}
                    </x-ui.title>
                </x-ui.modal.header>

                <x-ui.modal.body>
                    <p>{{ __('user.profile.delete_warning_1') }}</p>
                    <p>{{ __('user.profile.delete_warning_2') }}</p>
                </x-ui.modal.body>

                <x-ui.modal.footer align-buttons="right">
                    <x-ui.form class="modal__footer-buttons" method="delete" x-bind:action=$store.modalSingleDelete.action>
                        <x-ui.form.button class="modal__footer-button" x-bind:disabled="preventSubmit">
                            {{ __('common.delete') }}
                        </x-ui.form.button>

                        <x-ui.form.button
                            class="modal__footer-button"
                            x-on:click.prevent="$store.modalSingleDelete.hide = true"
                            color="cancel">
                            {{ __('common.close') }}
                        </x-ui.form.button>
                    </x-ui.form>
                </x-ui.modal.footer>
            </x-ui.modal.content>
        </x-ui.modal>
    @endpushonce

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('modalSingleDelete', {
                    hide: true,
                    action: false
                });
            });
        </script>
    @endpush
</x-layouts.main>

