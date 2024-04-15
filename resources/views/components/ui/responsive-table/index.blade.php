<div x-data="selectableTable">
<div
    {{ $attributes->class([
            'responsive-table'
        ])
    }}>

    {{ $slot }}
</div>
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
                x-on:click.stop="prepareModalData"
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
                ids: [],

            });

            Alpine.data('selectableTable', () => ({
                selectedNames:[],
                prepareModalData() {
                    this.$store.selectedModal.hide = ! this.$store.selectedModal.hide;
                    this.$store.selectedModal.action = this.actionSelect.value;
                    this.prepareSelectedNames(this.selectedNames);
                },
                prepareSelectedNames(selectedNames) {
                    console.log(selectedNames);
                    this.$store.selectedModal.names = selectedNames.join('<br>')
                },
                selectRow() {
                    if (this.$store.selectedModal.ids.includes(this.id)) {
                        const index = this.$store.selectedModal.ids.indexOf(this.id);
                        this.$store.selectedModal.ids.splice(index, 1)
                        const indexName = this.selectedNames.indexOf(this.name);
                        this.selectedNames.splice(indexName, 1)
                    } else {
                        this.$store.selectedModal.ids.push(this.id)
                        this.selectedNames.push(this.name)
                    }
                    console.log(this.$store.selectedModal.ids);
                },
            }))
        });
    </script>
@endpush
