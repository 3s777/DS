<div class="carrier__add-buttons">
    <x-libraries.choices
        class="choices-select-1"
        wrapper_class="choices-block_color_success carrier__add-select"
        id="select-test"
        name="select-test"
        show_label=""
        color="additional"
        label="На полку">
        <x-ui.form.option>Добавить</x-ui.form.option>
        <x-ui.form.option value="1">В коллекцию</x-ui.form.option>
        <x-ui.form.option value="2">Продать</x-ui.form.option>
        <x-ui.form.option value="3">Аукцион</x-ui.form.option>
        <x-ui.form.option value="4">Обменять</x-ui.form.option>
        <x-ui.form.option value="6">Список желаний</x-ui.form.option>
        <x-ui.form.option value="7">Создать пост</x-ui.form.option>
        <x-ui.form.option value="8">Избранное</x-ui.form.option>
    </x-libraries.choices>

    <x-ui.form.button
        color="dark"
        only_icon="true"
        title="Добавить в коллекцию">
        <x-slot:icon>
            <x-svg.check class="button__icon button__icon_big button__check-icon"></x-svg.check>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        color="dark"
        only_icon="true"
        title="Продать">
        <x-slot:icon>
            <x-svg.dollar class="button__icon button__icon_big button__dollar-icon"></x-svg.dollar>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        color="dark"
        only_icon="true"
        title="Выставить на аукцион">
        <x-slot:icon>
            <x-svg.auction class="button__icon button__icon_big button__auction-icon"></x-svg.auction>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        color="dark"
        only_icon="true"
        title="Обменять">
        <x-slot:icon>
            <x-svg.exchange class="button__icon button__icon_big button__exchange-icon"></x-svg.exchange>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        color="dark"
        only_icon="true"
        title="Добавить в список желаемого">
        <x-slot:icon>
            <x-svg.whishlist class="button__icon button__icon_big button__whishlist-icon"></x-svg.whishlist>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        color="dark"
        only_icon="true"
        title="Добавить публикацию">
        <x-slot:icon>
            <x-svg.edit class="button__icon button__icon_big button__edit-icon"></x-svg.edit>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        color="dark"
        only_icon="true"
        title="Добавить в избранное">
        <x-slot:icon>
            <x-svg.star class="button__icon button__icon_big button__star-icon"></x-svg.star>
        </x-slot:icon>
    </x-ui.form.button>
</div>
