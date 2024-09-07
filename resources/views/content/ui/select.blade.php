<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Select') }}</x-ui.title>
    <x-ui.card>
        <x-grid type="container">
            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-libraries.choices
                        class="choices-select-1"
                        id="select-test"
                        name="select-test"
                        label="Choose something">
                        <x-ui.form.option>Classic select</x-ui.form.option>
                        <x-ui.form.option value="1">Test 1</x-ui.form.option>
                        <x-ui.form.option value="2">Test 2</x-ui.form.option>
                        <x-ui.form.option value="3">Test 3</x-ui.form.option>
                    </x-libraries.choices>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-libraries.choices
                        class="choices-select-2"
                        id="select-test-2"
                        name="select-test-2"
                        label="Choose something" multiple>
                        <x-ui.form.option>Add multiple</x-ui.form.option>
                        <x-ui.form.option value="1" selected>Test 1</x-ui.form.option>
                        <x-ui.form.option value="2">Test2 test test</x-ui.form.option>
                        <x-ui.form.option value="3">Test3 words test bigwordwidth</x-ui.form.option>
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

            <x-grid.col xl="3" lg="4" md="6" sm="12">
                <x-ui.form.group>
                    <x-libraries.choices
                        class="choices-select-4"
                        id="select-test-4"
                        name="select-test-4"
                        label="Choose something"
                        input="true"
                        value="{{ old('text') }}"
                        required >
                    </x-libraries.choices>
                </x-ui.form.group>
            </x-grid.col>
        </x-grid>
    </x-ui.card>
</section>
