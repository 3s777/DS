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
                names: [],
                ids: [],
            });

            Alpine.store('modalMassForceDelete', {
                hide: true,
                action: '{{ route('game-developers.forceDelete') }}',
                names: [],
                ids: [],
            });

            Alpine.data('selectableTable', () => ({
                prepareSelectedForAction(actionSelect) {
                    if(actionSelect.value === 'delete' && this.$store.selectedRows.ids.length > 0) {
                        this.$store.modalMassDelete.hide = ! this.$store.modalMassDelete.hide;
                        this.$store.modalMassDelete.ids = this.$store.selectedRows.ids;
                        this.$store.modalMassDelete.names = this.$store.selectedRows.names.join('<br>')
                    }

                    if(actionSelect.value === 'forceDelete' && this.$store.selectedRows.ids.length > 0) {
                        this.$store.modalMassForceDelete.hide = ! this.$store.modalMassForceDelete.hide;
                        this.$store.modalMassForceDelete.ids = this.$store.selectedRows.ids;
                        this.$store.modalMassForceDelete.names = this.$store.selectedRows.names.join('<br>')
                    }
                },
            }))
        });
    </script>
@endpush
