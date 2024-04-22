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

                            @foreach($users as $user)
                                <x-ui.form.option
                                    value="{{ $user['id']}}"
                                    :selected="old('user_id') == $user['id']"
                                >{{ $user['name'] }}</x-ui.form.option>
                            @endforeach
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>



                <x-grid.col xl="3" lg="4" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-select-3"
                            id="select-test-3"
                            name="select-test-3"
                            label="Choose something">
                            <x-ui.form.option>Select with search</x-ui.form.option>
                            <x-ui.form.option value="1">Test 1</x-ui.form.option>
                            <x-ui.form.option value="2">Test 2</x-ui.form.option>
                            <x-ui.form.option value="3">Test 3</x-ui.form.option>
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

    <x-ui.test-select>
        <option>sadf</option>
        <option></option>
    </x-ui.test-select>

    @push('scripts')
        <script type="module">
            const users = document.querySelector('.user-select');
            const choices_users = new Choices(users, {
                allowHTML: true,
                itemSelectText: '',
                noResultsText: '{{ __('Не найдено') }}',
                noChoicesText: '{{ __('Больше ничего нет') }}',
            });

        </script>
    @endpush
</x-layouts.admin>
