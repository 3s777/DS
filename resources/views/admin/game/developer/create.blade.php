<x-layouts.admin :search="false">
    <x-ui.form class="crud-form" id="create-form" action="{{ route('game-developers.store') }}" enctype="multipart/form-data">
        <x-ui.title class="curd-form__tile" size="normal" indent="small">
            {{ __('game.developer.add') }}
        </x-ui.title>

        <div class="crud-form__main">
            <x-grid type="container">
                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            placeholder="{{ __('common.name') }}"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="on"
                            autofocus >
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            placeholder="{{ __('common.slug') }}"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="user-select"
                            id="user-select"
                            name="user_id"
                            label="{{ __('common.user') }}">
                            <x-ui.form.option value="">{{ __('common.choose_user') }}</x-ui.form.option>

{{--                            @foreach($users as $user)--}}
{{--                                <x-ui.form.option--}}
{{--                                    value="{{ $user['id']}}"--}}
{{--                                    :selected="old('user_id') == $user['id']"--}}
{{--                                >{{ $user['name'] }}</x-ui.form.option>--}}
{{--                            @endforeach--}}
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.rich-text-editor
                            name="description"
                            value=""
                            placeholder="{{ __('common.description') }}" />
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
        </div>

        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                <x-ui.form.input-image name="thumbnail" id="thumbnail">
                    <p>{{ __('common.file.format') }} jpg, png</p>
                    <p>{{ __('common.file.max_size') }} 6Mb</p>
                </x-ui.form.input-image>
            </div>
        </div>

        <x-ui.form.group class="crud-form__submit">
            <x-ui.form.button x-bind:disabled="preventSubmit">{{ __('common.add') }}</x-ui.form.button>
        </x-ui.form.group>
    </x-ui.form>



    @push('scripts')
        <script type="module">

            const users = document.querySelector('.user-select');


            let tee = {
                name: 'test',
                searchTerms: null,
                asyncUrl: '{{ route('find-users') }}',

                fromUrl(url) {
                    return fetch(url)
                        .then(response => {
                            return response.json()
                        })
                        .then(json => {
                            return json
                        })
                },


                async asyncSearch() {
                    const url = new URL(this.asyncUrl)

                    const query = this.searchTerms.value ?? null

                    if (query !== null && query.length) {
                        url.searchParams.append('query', query)
                    }

                    const options = await this.fromUrl(url.toString())

                    console.log(url.toString());

                    choices_users.setChoices(options, 'value', 'label', true)
                }
            };


            const choices_users = new Choices(users, {
                allowHTML: true,
                itemSelectText: '',
                noResultsText: '{{ __('Не найдено') }}',
                noChoicesText: '{{ __('Больше ничего нет') }}',
                callbackOnInit: () => {
                    tee.searchTerms = users.closest('.choices').querySelector('[name="search_terms"]')
                    tee.asyncSearch();
                },
            });


            tee.searchTerms.addEventListener(
                'input',
                function (event) {
                    choices_users.clearStore()
                    tee.asyncSearch()
                },
                false,
            )


        </script>
    @endpush
</x-layouts.admin>
