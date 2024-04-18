@props([
    'modelName',
    'delete' => true,
    'selectable' => true,
    'massDelete' => true,
])

<div @if($selectable) x-data="selectableTable" @endif
    {{ $attributes->class([
            'action-table'
        ])
    }}>

    {{ $slot }}
</div>

@if($delete)
    <x-common.action-table.modal-delete />
@endif

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {

            @if($delete)
                Alpine.store('modalSingleDelete', {
                    hide: true,
                    action: false,
                    name: false
                });
            @endif

            @if($selectable)
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

                        checkboxes = document.querySelectorAll('[id^=selected_row]');
                        [...checkboxes].map((el) => {
                            el.checked = this.selectall;
                        })
                    }
                }))

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

                @if($massDelete)
                    Alpine.store('modalMassDelete', {
                        hide: true,
                        action: '',
                        title: '',
                        names: [],
                        ids: [],
                        prepareDeleteModal(actionSelect, ids, names) {
                            if(ids.length > 0) {
                                this.hide = ! this.hide;
                                this.ids = ids.slice();
                                this.names = names.slice().join('<br>');
                                switch (actionSelect.value) {
                                    case 'delete':
                                        this.action = '{{ route($modelName.'.delete') }}';
                                        this.title = "{{ __('common.deleting') }}";
                                        break;
                                    case 'forceDelete':
                                        this.action = '{{ route($modelName.'.forceDelete') }}';
                                        this.title = '{{ __('common.force_deleting') }}';
                                        break;
                                }
                            }
                        },
                    });
                @endif
            @endif
        });
    </script>
@endpush
