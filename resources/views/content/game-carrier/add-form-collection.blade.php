<div class="carrier__add-form">

    <div x-cloak x-show="currentForm(form) == 'add'">
        <x-ui.title indent="normal">{{ __('Добавить в коллекцию') }}</x-ui.title>
    </div>

    <div x-cloak x-show="currentForm(form) == 'sale'">
        <x-ui.title indent="normal">{{ __('Продать') }}</x-ui.title>
        <x-grid type="container">
            <x-grid.col lg="6" xl="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.input-text
                        :errors="$errors"
                        placeholder="Цена"
                        id="text"
                        name="text"
                        value="{{ old('text') }}"
                        type="number"
                        required
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>
            <x-grid.col lg="6" xl="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-libraries.choices
                        class="choices-select-auto"
                        id="select-test"
                        name="select-test"
                        label="Выберите валюту">
                        <x-ui.form.option value="1">Рубли</x-ui.form.option>
                        <x-ui.form.option value="1">Гривны</x-ui.form.option>
                        <x-ui.form.option value="2">Доллары</x-ui.form.option>
                    </x-libraries.choices>
                </x-ui.form.group>
            </x-grid.col>
        </x-grid>
    </div>

    <div x-cloak x-show="currentForm(form) == 'auction'">
        <x-ui.title indent="normal">{{ __('Добавить аукцион') }}</x-ui.title>
        <x-grid type="container">
            <x-grid.col lg="6" xl="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.input-text
                        :errors="$errors"
                        placeholder="Начальная ставка"
                        id="text"
                        name="text"
                        value="{{ old('text') }}"
                        type="number"
                        required
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>
            <x-grid.col lg="6" xl="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-libraries.choices
                        class="choices-select-auto"
                        id="select-test"
                        name="select-test"
                        label="Выберите валюту">
                        <x-ui.form.option value="1">Рубли</x-ui.form.option>
                        <x-ui.form.option value="1">Гривны</x-ui.form.option>
                        <x-ui.form.option value="2">Доллары</x-ui.form.option>
                    </x-libraries.choices>
                </x-ui.form.group>
            </x-grid.col>
            <x-grid.col lg="6" xl="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.input-text
                        :errors="$errors"
                        placeholder="Шаг торгов"
                        id="text"
                        name="text"
                        value="{{ old('text') }}"
                        type="number"
                        required
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>
            <x-grid.col xl="6" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.datepicker
                        :errors="$errors"
                        id="date"
                        name="date"
                        placeholder="Дата окончания"
                        value="{{ old('date') }}"
                        required>
                    </x-ui.form.datepicker>
                </x-ui.form.group>
            </x-grid.col>
        </x-grid>
    </div>

    <div x-cloak x-show="currentForm(form) == 'exchange'">
        <x-ui.title indent="normal">{{ __('Обменять') }}</x-ui.title>
    </div>

    <div x-cloak x-show="currentForm(form) == 'post'">
        <x-ui.title indent="normal">{{ __('Создать пост') }}</x-ui.title>
    </div>

    <x-grid type="container">
        <x-grid.col lg="6" xl="6" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.form.input-text
                    :errors="$errors"
                    placeholder="Название"
                    id="text"
                    name="text"
                    value="BLES00789, Resonance of Fate, Playstation 3"
                    required
                    autocomplete="on">
                </x-ui.form.input-text>
            </x-ui.form.group>
        </x-grid.col>
        <x-grid.col lg="6" xl="6" md="6" sm="12">
            <x-ui.form.group>
                <x-libraries.choices
                    class="choices-select-auto"
                    id="select-shelf"
                    name="select-shelf"
                    label="Выберите полку">
                    <x-ui.form.option value="1">Стандартная полка</x-ui.form.option>
                    <x-ui.form.option value="2">Полка третья</x-ui.form.option>
                </x-libraries.choices>
            </x-ui.form.group>
        </x-grid.col>
        <x-grid.col lg="6" xl="6" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.form.input-text
                    :errors="$errors"
                    placeholder="Свой артикул"
                    id="text"
                    name="text"
                    value="{{ old('text') }}"
                    required
                    autocomplete="on">
                </x-ui.form.input-text>
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col lg="6" xl="6" md="6" sm="12">
            <x-ui.form.group>
                <x-libraries.choices
                    class="choices-select-auto"
                    id="select-test-state"
                    name="select-test-state"
                    label="Состояние">
                    <x-ui.form.option value="1">Б/У</x-ui.form.option>
                    <x-ui.form.option value="2">Новый (силд)</x-ui.form.option>
                    <x-ui.form.option value="3">Перепак</x-ui.form.option>
                    <x-ui.form.option value="4">Промо</x-ui.form.option>
                    <x-ui.form.option value="5">Кастом</x-ui.form.option>
                </x-libraries.choices>
            </x-ui.form.group>
        </x-grid.col>


        <x-grid.col xl="6" lg="6" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.star-rating
                    class="carrier__add-rating"
                    title="Диск"
                    name="disk">
                </x-ui.star-rating>

            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="6" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.star-rating
                    class="carrier__add-rating"
                    title="Мануал"
                    name="manual">
                </x-ui.star-rating>

            </x-ui.form.group>
        </x-grid.col>


        <x-grid.col xl="6" lg="6" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.star-rating
                    class="carrier__add-rating"
                    title="Коробка"
                    name="box">
                </x-ui.star-rating>
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="6" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.star-rating
                    class="carrier__add-rating"
                    title="Обложка"
                    name="cover">
                </x-ui.star-rating>
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="6" md="6" sm="12">
            <x-ui.form.group>
                <x-libraries.filepond
                    class="filepond1"
                    name="filepond"
                    accept="image/png, image/jpeg, image/gif"
                    multiple>
                </x-libraries.filepond>
            </x-ui.form.group>
        </x-grid.col>
        <x-grid.col xl="6" lg="6" md="6" sm="12">
            <x-ui.form.group>
                <x-libraries.filepond
                    class="filepond2"
                    name="filepond"
                    multiple
                    data-allow-reorder="true"
                    data-max-file-size="3MB"
                    data-max-files="3">
                </x-libraries.filepond>
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col lg="12" xl="12" md="12" sm="12">
            <x-ui.form.group>
                <x-ui.form.textarea
                    :errors="$errors"
                    id="textarea"
                    name="textarea"
                    placeholder="{{ __('Заметки и коментарии') }}">
                    {{ old('textarea') }}
                </x-ui.form.textarea>
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col lg="12" xl="12" md="12" sm="12">
            <x-ui.form.group>
                <x-ui.accordion>
                <x-ui.accordion.item class="carrier__additional-fields" color="light">

                    <x-ui.accordion.title>Дополнительные поля</x-ui.accordion.title>
                    <x-ui.accordion.content>

                        <x-grid type="container">

                        <x-grid.col lg="6" xl="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    :errors="$errors"
                                    placeholder="Цена покупки"
                                    id="text"
                                    name="text"
                                    value="{{ old('text') }}"
                                    type="number"
                                    required
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col lg="6" xl="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    :errors="$errors"
                                    placeholder="Место покупки"
                                    id="text"
                                    name="text"
                                    value="{{ old('text') }}"
                                    required
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>


                        <x-grid.col xl="6" lg="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.datepicker
                                    :errors="$errors"
                                    id="date"
                                    name="date"
                                    placeholder="Дата покупки"
                                    value="{{ old('date') }}"
                                    required>
                                </x-ui.form.datepicker>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col lg="6" xl="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-libraries.choices
                                    class="choices-select-auto"
                                    id="select-test-box"
                                    name="select-test-box"
                                    label="Тип бокса">
                                    <x-ui.form.option value="">Не указывать</x-ui.form.option>
                                    <x-ui.form.option value="1">Red Label</x-ui.form.option>
                                    <x-ui.form.option value="2">Black Label</x-ui.form.option>
                                    <x-ui.form.option value="3">Black Label Мягкий</x-ui.form.option>
                                    <x-ui.form.option value="4">Промо</x-ui.form.option>
                                    <x-ui.form.option value="5">Blue Ray</x-ui.form.option>
                                </x-libraries.choices>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col lg="6" xl="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    :errors="$errors"
                                    placeholder="Свое поле"
                                    id="text"
                                    name="text"
                                    value="{{ old('text') }}"
                                    required
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col lg="6" xl="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    :errors="$errors"
                                    placeholder="Свое поле"
                                    id="text"
                                    name="text"
                                    value="{{ old('text') }}"
                                    required
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col lg="6" xl="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.switcher
                                    name="switcher1"
                                    label="{{ __('Игра пройдена') }}"
                                >
                                </x-ui.form.switcher>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col lg="6" xl="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.switcher
                                    name="switcher2"
                                    label="{{ __('Наличие цифровой версии') }}"
                                >
                                </x-ui.form.switcher>
                            </x-ui.form.group>
                        </x-grid.col>

                        </x-grid>
                    </x-ui.accordion.content>
                </x-ui.accordion.item>
            </x-ui.accordion>
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col lg="12" xl="12" md="12" sm="12">
            <x-ui.form.group>
                <x-ui.form.button type="submit" full_width="true">Добавить</x-ui.form.button>
            </x-ui.form.group>
        </x-grid.col>

    </x-grid>

</div>
