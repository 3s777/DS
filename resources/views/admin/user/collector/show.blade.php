<x-layouts.admin :search="false">
            <x-ui.title class="crud-show__title" size="normal" indent="small">
                {{ $collector->name }} - {{ $collector->first_name }}
            </x-ui.title>

            <div class="crud-show user-show-admin">
                <div class="crud-show__content">
                    <x-ui.specifications>
                        <x-ui.specifications.item class="crud-show__specification" :title="__('auth.username')">
                            <x-ui.tag :disabled="true" tag="div" color="dark">{{ $collector->name }}</x-ui.tag>
                        </x-ui.specifications.item>

                        <x-ui.specifications.item class="crud-show__specification" :title="__('auth.first_name')">
                            <x-ui.tag :disabled="true" tag="div" color="dark">{{ $collector->first_name }}</x-ui.tag>
                        </x-ui.specifications.item>

                        <x-ui.specifications.item class="crud-show__specification" :title="__('common.email')">
                            <x-ui.tag :disabled="true" tag="div" color="dark">{{ $collector->email }}</x-ui.tag>
                        </x-ui.specifications.item>

                        <x-ui.specifications.item class="crud-show__specification" :title="__('common.language')">
                            <x-ui.tag :disabled="true" tag="div" color="dark">{{ $collector->language }}</x-ui.tag>
                        </x-ui.specifications.item>

                        <x-ui.specifications.item class="crud-show__specification" :title="trans_choice('user.role.roles', 2)">
                            @foreach($collector->roles as $role)
                                <x-ui.tag :disabled="true" tag="div" color="dark">{{ $role->display_name }}</x-ui.tag>
                            @endforeach
                        </x-ui.specifications.item>

                        <x-ui.specifications.item class="crud-show__specification" :title="trans_choice('user.permission.permissions', 2)">
                            @foreach($collector->permissions as $permission)
                                <x-ui.tag :disabled="true" tag="div" color="dark">{{ $permission->display_name }}</x-ui.tag>
                            @endforeach
                        </x-ui.specifications.item>
                    </x-ui.specifications>

                    @if($collector->description)
                        <div class="crud-show__description">
                            <div class="crud-show__description-title">
                                {{ __('common.description_notes') }}:
                            </div>
                            {!! $collector->description !!}
                        </div>
                    @endif
                </div>

                <div class="crud-show__sidebar">
                    <div class="crud-show__thumbnail">
                        <a href="{{ asset('storage/images/'.$collector->getFeaturedImagePathWebp())  }}" data-fancybox data-caption="">
                        <x-ui.responsive-image
                            :model="$collector"
                            :image-sizes="['small', 'medium', 'large']"
                            :path="$collector->getFeaturedImagePath()"
                            sizes="(max-width: 1024px) 100vw, (max-width: 1400px) 30vw, 220px">
                            <x-slot:img height="220" width="220" alt="test" title="test title"></x-slot:img>
                        </x-ui.responsive-image>
                        </a>
                    </div>
                </div>

                <div class="crud-show__action-buttons" x-data x-on:keydown.escape.window="$store.modalDelete.hide = true">
                    <x-ui.form.button class="crud-show__action-button" tag="a">{{ __('user.to_profile') }}</x-ui.form.button>
                    <x-ui.form.button class="crud-show__action-button" tag="a" :href="route('admin.users.edit', $collector->slug)" color="warning">{{ __('common.edit') }}</x-ui.form.button>
                    <x-ui.form.button class="crud-show__action-button" x-on:click.stop="
                        $store.modalDelete.hide = ! $store.modalDelete.hide;
                        $store.modalDelete.action = '{{ route('admin.users.destroy', $collector->slug) }}'
                        $store.modalDelete.name = '{{ $collector->name }}'"
                        tag="a" color="cancel">
                        {{ __('common.delete') }}
                    </x-ui.form.button>
                </div>
            </div>

    <x-ui.modal x-data tag="section" ::class="$store.modalDelete.hide ? '' : 'modal_show'">
        <x-ui.modal.content
            x-on:click.outside="$store.modalDelete.hide = true">
            <x-ui.modal.close x-on:click="$store.modalDelete.hide = true" />

            <x-ui.modal.header>
                <x-ui.title
                    size="normal"
                    indent="normal">
                    {{ __('common.deleting') }}
                </x-ui.title>
            </x-ui.modal.header>

            <x-ui.modal.body>
                {{ __('common.delete_confirmation') }} <span x-text="$store.modalDelete.name"></span>?
            </x-ui.modal.body>

            <x-ui.modal.footer align-buttons="right">
                <x-ui.form class="modal__footer-buttons" method="delete" x-bind:action=$store.modalDelete.action>
                    <x-ui.form.button class="modal__footer-button" x-bind:disabled="preventSubmit">
                        {{ __('common.delete') }}
                    </x-ui.form.button>

                    <x-ui.form.button
                        class="modal__footer-button"
                        x-on:click.prevent="$store.modalDelete.hide = true"
                        color="cancel">
                        {{ __('common.close') }}
                    </x-ui.form.button>
                </x-ui.form>
            </x-ui.modal.footer>
        </x-ui.modal.content>
    </x-ui.modal>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('modalDelete', {
                    hide: true,
                    action: false,
                    name: false
                });
            });
        </script>
    @endpush
</x-layouts.admin>
