<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
        <x-common.content class="admin" wrapper-class="admin__content">
            <x-slot:sidebar>
                <x-common.sidebar-menu class="admin__menu" />
            </x-slot:sidebar>

            <x-ui.title size="normal" indent="big">Список игровых разработчиков</x-ui.title>

            <x-common.messages />

            <table class="sort-table" id="developers">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th width="140">Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($developers as $developer)
                    <tr>
                        <td>{{ $developer->id }}</td>
                        <td>{{ $developer->name }}</td>
                        <td>{{ $developer->slug }}</td>
                        <td>
                            <div class="sort-table__buttons">

                                <x-ui.form.button
                                    tag="a"
                                    link="{{ route('game-developers.edit', $developer->slug) }}"
                                    color="warning"
                                    only-icon="true"
                                    size="small">
                                    <x-slot:icon class="button__icon-wrapper_edit">
                                        <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form method="delete" action="{{ route('game-developers.destroy', $developer->slug) }}">
                                    <x-ui.form.button
                                        color="cancel"
                                        only-icon="true"
                                        size="small">
                                        <x-slot:icon class="button__icon-wrapper_cancel">
                                            <x-svg.close class="button__icon button__icon_small"></x-svg.close>
                                        </x-slot:icon>
                                    </x-ui.form.button>
                                </x-ui.form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-common.content>
    </x-grid.container>

    @push('scripts')
        <script type="module">
            var selects = document.getElementsByClassName("choices-select-auto");
            for (var i = 0; i < selects.length; i++) {
                new Choices(selects.item(i), {
                    itemSelectText: '',
                    searchEnabled: false,
                    shouldSort: false,
                    allowHTML: true,
                    noResultsText: '{{ __('Не найдено') }}',
                    noChoicesText: '{{ __('Больше ничего нет') }}',
                });
            }

            var table = new Tabulator("#developers", {
                layout:"fitColumns",
                rowHeight:'auto',
                footerElement:"<button class='button button_submit'>Custom Button</button class='button button_submit'>",
                responsiveLayout:"collapse",  //fit columns to width of table (optional)
                columns:[
                    {
                        title: "id"
                    },
                    {
                        title: "Name"
                    },
                    {
                        title: "Slug"
                    },
                    {
                        title: "Edit",
                        formatter: (cell) => cell.getValue()
                    },
                ],
            });
        </script>
    @endpush
</x-layouts.main>
