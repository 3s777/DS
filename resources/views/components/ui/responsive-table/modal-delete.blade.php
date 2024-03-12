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
            {{ __('common.delete-confirmation') }} <span x-text="$store.modalDelete.name"></span>?
        </x-ui.modal.body>

        <x-ui.modal.footer align-buttons="right">
            <x-ui.form method="delete" x-bind:action=$store.modalDelete.action>
                <x-ui.form.button x-bind:disabled="preventSubmit">
                    {{ __('common.delete') }}
                </x-ui.form.button>

                <x-ui.form.button
                    x-on:click.prevent="$store.modalDelete.hide = true"
                    color="cancel"
                    indent="left">
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
        })
    </script>
@endpush
