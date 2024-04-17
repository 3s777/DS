<x-ui.modal x-data tag="section" ::class="$store.modalMassForceDelete.hide ? '' : 'modal_show'">
    <x-ui.modal.content
        x-on:click.outside="$store.modalMassForceDelete.hide = true">
        <x-ui.modal.close x-on:click="$store.modalMassForceDelete.hide = true" />

        <x-ui.modal.header>
            <x-ui.title
                size="normal"
                indent="normal">
                {{ __('common.deleting') }}
            </x-ui.title>
        </x-ui.modal.header>

        <x-ui.modal.body>
            {{ __('common.delete_confirmation') }}?
            <div x-html="$store.modalMassForceDelete.names"></div>
        </x-ui.modal.body>

        <x-ui.modal.footer align-buttons="right">
            <x-ui.form method="DELETE" x-bind:action="$store.modalMassForceDelete.action">
                <input type="hidden" name="ids" x-bind:value="$store.modalMassForceDelete.ids">
                {{--            <x-ui.form method="delete" x-bind:action=$store.modalMassForceDelete.action>--}}
                <x-ui.form.button x-bind:disabled="preventSubmit">
                    {{ __('common.delete') }}
                </x-ui.form.button>

                <x-ui.form.button
                    x-on:click.prevent="$store.modalMassForceDelete.hide = true"
                    color="cancel"
                    indent="left">
                    {{ __('common.close') }}
                </x-ui.form.button>
            </x-ui.form>
        </x-ui.modal.footer>
    </x-ui.modal.content>
</x-ui.modal>