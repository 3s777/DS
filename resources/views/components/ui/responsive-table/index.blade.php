<div x-data="selectedRows">
<div
    {{ $attributes->class([
            'responsive-table'
        ])
    }}>

    {{ $slot }}
</div>
<span x-text="selectedRows"></span>
<span x-html="selectedNames"></span>
<form action="">
    <input type="hidden" name="selected_rows[]" x-model="selectedRows">
</form>
<div class="responsive-table__footer">
    <div x-data="{ actionSelect: '' }" class="responsive-table__action">
        <x-libraries.choices
            x-model="actionSelect"
            class="responsive-table__select-action"
            size="small"
            id="responsive-table__select-action"
            name="responsive-table__select-action"
            label="Действие с отмеченными">
            <x-ui.form.option value="delete">Удалить</x-ui.form.option>
            <x-ui.form.option value="forceDelete">Удалить навсегда</x-ui.form.option>
        </x-libraries.choices>
        <div x-on:keydown.escape.window="$store.selectedModal.hide = true">
            <x-ui.form.button
                tag="div"
                x-on:click.stop="
                console.log(selectedNames);
            $store.selectedModal.hide = ! $store.selectedModal.hide;
            $store.selectedModal.action = actionSelect.value
            $store.selectedModal.ids = selectedRows
            $store.selectedModal.prepareSelectedNames(selectedNames)"
            >Применить</x-ui.form.button>
        </div>
    </div>
</div>
</div>

<x-ui.modal x-data tag="section" ::class="$store.selectedModal.hide ? '' : 'modal_show'">
    <x-ui.modal.content
        x-on:click.outside="$store.selectedModal.hide = true">
        <x-ui.modal.close x-on:click="$store.selectedModal.hide = true" />

        <x-ui.modal.header>
            <x-ui.title
                size="normal"
                indent="normal">
                {{ __('common.deleting') }}
            </x-ui.title>
        </x-ui.modal.header>

        <x-ui.modal.body>
            {{ __('common.delete_confirmation') }}?
            <div x-html="$store.selectedModal.names"></div>
        </x-ui.modal.body>

        <x-ui.modal.footer align-buttons="right">
            <x-ui.form method="DELETE" action="{{ route('game-developers.delete') }}">
                <input type="hidden" name="ids" x-bind:value="$store.selectedModal.ids">
{{--            <x-ui.form method="delete" x-bind:action=$store.selectedModal.action>--}}
                <x-ui.form.button x-bind:disabled="preventSubmit">
                    {{ __('common.delete') }}
                </x-ui.form.button>

                <x-ui.form.button
                    x-on:click.prevent="$store.selectedModal.hide = true"
                    color="cancel"
                    indent="left">
                    {{ __('common.close') }}
                </x-ui.form.button>
            </x-ui.form>
        </x-ui.modal.footer>
    </x-ui.modal.content>
</x-ui.modal>

@push('scripts')
    <script type="module">
        const element1 = document.querySelector('.responsive-table__select-action');
        const choices1 = new Choices(element1, {
            itemSelectText: '',
            searchEnabled: false,
        });
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('modalDelete', {
                hide: true,
                action: false,
                name: false
            });

            Alpine.store('selectedModal', {
                hide: true,
                action: false,
                names: false,
                ids: false,
                prepareSelectedNames(selectedNames) {
                    this.names = selectedNames.join('<br>')
                },
            });
            Alpine.data('selectedRows', () => ({
                selectedRows:[],
                selectedNames:[],
                id:'',
                name:'',
                selectRow() {
                    if (this.selectedRows.includes(this.id)) {
                        const index = this.selectedRows.indexOf(this.id);
                        this.selectedRows.splice(index, 1)
                        const indexName = this.selectedNames.indexOf(this.name);
                        this.selectedNames.splice(indexName, 1)
                    } else {
                        this.selectedRows.push(this.id)
                        this.selectedNames.push(this.name)
                    }
                    console.log(this.selectedRows);
                },
            }))
        });
    </script>
@endpush
