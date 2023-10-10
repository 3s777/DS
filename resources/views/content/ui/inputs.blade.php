<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Inputs') }}</x-ui.title>

    <x-ui.card class="card">
        <x-grid type="container">
            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.title size="small" >{{ __('Text input') }}</x-ui.title>
                <x-ui.form.group>
                    <x-ui.form.input-text
                        :errors="$errors"
                        placeholder="Enter here text"
                        id="text"
                        name="text"
                        value="{{ old('text') }}"
                        required
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.title size="small" >{{ __('Text input with error') }}</x-ui.title>

                <x-ui.form.group>
                    <x-ui.form.input-text
                        class="input-text__field_error"
                        :errors="$errors"
                        id="text"
                        name="text"
                        value="{{ old('text') }}"
                        placeholder="Test"
                        required
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.title size="small" >{{ __('Datepicker') }}</x-ui.title>

                <x-ui.form.group>
                    <x-ui.form.datepicker
                        :errors="$errors"
                        id="date"
                        name="date"
                        value="{{ old('date') }}"
                        required>
                    </x-ui.form.datepicker>
                </x-ui.form.group>
            </x-grid.col>
        </x-grid>

        <x-ui.title size="small" >{{ __('Textarea') }}</x-ui.title>
        <x-ui.form.group>
            <x-ui.form.textarea
                :errors="$errors"
                id="textarea"
                name="textarea"
                placeholder="{{ __('Textarea placeholder') }}">
                {{ old('textarea') }}
            </x-ui.form.textarea>
        </x-ui.form.group>

        <x-ui.title size="small" >{{ __('Quill') }}</x-ui.title>
        <x-ui.form.group>
            <div id="editor">
                <h1>Hello World!</h1>
                <p>Some initial <strong>bold</strong> text</p>
            </div>
        </x-ui.form.group>

        {{--<div id="editorjs"></div>--}}

    </x-ui.card>

</section>
