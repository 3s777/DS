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
            Alpine.store('selectedRows', {
                ids: [],
                names: [],
                select(id, name) {
                    if (this.ids.includes(id)) {
                        const index = this.ids.indexOf(id);
                        this.ids.splice(index, 1)

                        const indexName = this.names.indexOf(name);
                        this.names.splice(indexName, 1)
                    } else {
                        this.ids.push(id)
                        this.names.push(name)
                    }
                },
            });

            Alpine.store('modalSingleDelete', {
                hide: true,
                action: false,
                name: false
            });

            Alpine.store('modalMassDelete', {
                hide: true,
                action: '{{ route('game-developers.delete') }}',
                title: '',
                names: [],
                ids: [],
            });

            Alpine.data('selectableTable', () => ({
                selectall: false,
                toggleAllCheckboxes(allIds, allNames) {

                    this.selectall = !this.selectall

                    if(!this.selectall) {

                        allIds = [];
                        allNames = [];


                    }

                    this.$store.selectedRows.ids = allIds.slice();
                    this.$store.selectedRows.names = allNames.slice();

console.log(allIds)


                    checkboxes = document.querySelectorAll('[id^=selected_row]');
                    [...checkboxes].map((el) => {
                        el.checked = this.selectall;
                    })
                },
                prepareDeleteModal(actionSelect) {
                    if(this.$store.selectedRows.ids.length > 0) {
                        this.$store.modalMassDelete.hide = ! this.$store.modalMassDelete.hide;
                        this.$store.modalMassDelete.ids = this.$store.selectedRows.ids.slice();
                        this.$store.modalMassDelete.names = this.$store.selectedRows.names.slice().join('<br>');
                        switch (actionSelect.value) {
                            case 'delete':
                                this.$store.modalMassDelete.action = '{{ route('game-developers.delete') }}';
                                this.$store.modalMassDelete.title = "{{ __('common.deleting') }}";
                                break;
                            case 'forceDelete':
                                this.$store.modalMassDelete.action = '{{ route('game-developers.forceDelete') }}';
                                this.$store.modalMassDelete.title = '{{ __('common.force_deleting') }}';
                                break;
                        }
                    }
                },
            }))
        });
    </script>
@endpush
