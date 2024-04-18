@props([
    'action' => false
])

@aware([
    'massDelete' => true,
])

<div x-data="{ actionSelect: ''}" class="action-table__action">
    <x-libraries.choices
        x-model="actionSelect"
        class="action-table__select"
        size="small"
        id="action-table__select"
        name="action-table__select"
    >
        <x-ui.form.option>{{ __('common.choose_action') }}</x-ui.form.option>
        @if($massDelete)
            <x-ui.form.option value="delete">{{ __('common.delete') }}</x-ui.form.option>
            <x-ui.form.option value="forceDelete">{{ __('common.force_delete') }}</x-ui.form.option>
        @endif
            {{ $slot }}
    </x-libraries.choices>

    @if($action)
        {{ $action }}
    @endif

    <template x-if="actionSelect.value === 'delete' || actionSelect.value === 'forceDelete'">
        <div x-on:keydown.escape.window="$store.modalMassDelete.hide = true">
            <x-ui.form.button
                tag="div"
                x-on:click.stop="$store.modalMassDelete.prepareDeleteModal(
                    actionSelect,
                    $store.selectedRows.ids,
                    $store.selectedRows.names
                )">
                {{ __('common.apply') }}
            </x-ui.form.button>
        </div>
    </template>
</div>

@if($massDelete)
    <x-common.action-table.modal-mass-delete />
@endif

@push('scripts')
    <script type="module">
        const selectAction = document.querySelector('.action-table__select');
        const actionChoices = new Choices(selectAction, {
            allowHTML: true,
            itemSelectText: '',
            searchEnabled: false,
        });
    </script>
@endpush
