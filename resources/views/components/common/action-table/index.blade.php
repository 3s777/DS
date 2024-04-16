<div x-data="selectableTable"
    {{ $attributes->class([
            'action-table'
        ])
    }}>

    {{ $slot }}
</div>

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
                title: '',
            });


            Alpine.data('selectableTable', () => ({
                pr: {
                    test: {
                        title:'xcvx'
                    },
                    test1: {
                        title:'x5cvx'
                    }
                },
                selectedNames:[],
                prepareModalData(actionSelect) {


                    if(actionSelect && actionSelect.value) {
                        this.$store.selectedModal.hide = ! this.$store.selectedModal.hide;
                        this.$store.selectedModal.action = this.actionSelect;
                        this.prepareSelectedNames(this.selectedNames);

                        switch (this.$store.selectedModal.action.value) {
                            case this.$store.selectedModal.action.value:
                                alert( this.pr.title );
                                break;

                        }
                    }
                },
                prepareSelectedNames(selectedNames) {
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
                },
            }))
        });
    </script>
@endpush
