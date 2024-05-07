@props([
    'sorters'
])

<div {{ $attributes->class([
    'selectable-order'
    ]) }}

     x-data="{sort: '{{ filter_url(['sort' => request('sort'), 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}'}">
    <x-libraries.choices
        id="" x-model="sort"
        x-on:change="window.location = sort.value"
        class="selectable-order__choices"
        id="selectable-order__choices"
        name="selectable-order__choices"
        label="{{ __('common.sort') }}">
        <x-ui.form.option value="">{{ __('common.sort_by') }}</x-ui.form.option>
        <option
            value="{{ filter_url(['sort' => 'id', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">id</option>
        <option
            value="{{ filter_url(['sort' => 'name', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">Название</option>
        <option
            value="{{ filter_url(['sort' => 'users.name', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">Пользователь</option>
        <option
            value="{{ filter_url(['sort' => 'created_at', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">Добавлен</option>
    </x-libraries.choices>

    @if(request('sort'))
        <x-ui.form.button class="selectable-order__button" color="dark" tag="a" href="{{ filter_url(['sort' => request('sort'), 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
            <div class="selectable-order__arrow
                    @if(request('order') == 'asc' && request('sort') == request('sort')) selectable-order__arrow_active @endif">
            </div>
            <div class="selectable-order__arrow selectable-order__arrow_desc
                    @if(request('order') == 'desc' && request('sort') == request('sort')) selectable-order__arrow_active @endif">
            </div>
        </x-ui.form.button>
    @endif
</div>

@push('scripts')
    <script type="module">
        const element1 = document.querySelector('.selectable-order__choices');
        const choices1 = new Choices(element1, {
            itemSelectText: '',
            searchEnabled: false,
        });
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('modalTest', {
                hide: true,
                test(actionSelect) {
                    console.log(actionSelect);
                }
            });
        });
    </script>
@endpush
