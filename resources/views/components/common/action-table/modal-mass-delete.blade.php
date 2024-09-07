<x-ui.modal x-data  tag="section" ::class="$store.modalMassDelete.hide ? '' : 'modal_show'">
    <x-ui.modal.content
        x-on:click.outside="$store.modalMassDelete.hide = true">
        <x-ui.modal.close x-on:click="$store.modalMassDelete.hide = true" />

        <x-ui.modal.header>
            <x-ui.title
                x-text="$store.modalMassDelete.title"
                size="normal"
                indent="normal">
            </x-ui.title>
        </x-ui.modal.header>

        <x-ui.modal.body>
            {{ __('common.delete_confirmation') }}?
            <div x-html="$store.modalMassDelete.names"></div>
        </x-ui.modal.body>

        <x-ui.modal.footer align-buttons="right">
            <x-ui.form class="modal__footer-buttons" method="DELETE" x-bind:action="$store.modalMassDelete.action">
                <input type="hidden" name="ids" x-bind:value="$store.modalMassDelete.ids">
                <x-ui.form.button class="modal__footer-button" x-bind:disabled="preventSubmit">
                    {{ __('common.delete') }}
                </x-ui.form.button>

                <x-ui.form.button
                    class="modal__footer-button"
                    x-on:click.prevent="$store.modalMassDelete.hide = true"
                    color="cancel">
                    {{ __('common.close') }}
                </x-ui.form.button>
            </x-ui.form>
        </x-ui.modal.footer>
    </x-ui.modal.content>
</x-ui.modal>
