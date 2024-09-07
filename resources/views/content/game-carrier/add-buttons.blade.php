<div class="carrier__add-buttons">
    <x-libraries.choices
        x-model="form"
        class="choices-select-1"
        wrapper-class="choices-block_color_success carrier__add-select"
        id="select-test"
        name="select-test"
        show-label=""
        color="additional"
        label="На полку">
        <x-ui.form.option>Добавить</x-ui.form.option>
        <x-ui.form.option value="add">В коллекцию</x-ui.form.option>
        <x-ui.form.option value="sale">Продать</x-ui.form.option>
        <x-ui.form.option value="auction">Аукцион</x-ui.form.option>
        <x-ui.form.option value="exchange">Обменять</x-ui.form.option>
        <x-ui.form.option value="post">Создать пост</x-ui.form.option>
        <x-ui.form.option value="wishlist">Список желаний</x-ui.form.option>
        <x-ui.form.option value="favorite">Избранное</x-ui.form.option>
    </x-libraries.choices>

    <x-ui.form.button
        x-on:click="setForm('add')"
        x-bind:class="activateButton('add')"
        color="dark"
        only-icon="true"
        title="Добавить в коллекцию">
        <x-slot:icon>
            <x-svg.check class="button__icon button__icon_big button__check-icon"></x-svg.check>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        x-on:click="setForm('sale')"
        x-bind:class="activateButton('sale')"
        color="dark"
        only-icon="true"
        title="Продать">
        <x-slot:icon>
            <x-svg.dollar class="button__icon button__icon_big button__dollar-icon"></x-svg.dollar>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        x-on:click="setForm('auction')"
        x-bind:class="activateButton('auction')"
        color="dark"
        only-icon="true"
        title="Выставить на аукцион">
        <x-slot:icon>
            <x-svg.auction class="button__icon button__icon_big button__auction-icon"></x-svg.auction>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        x-on:click="setForm('exchange')"
        x-bind:class="activateButton('exchange')"
        color="dark"
        only-icon="true"
        title="Обменять">
        <x-slot:icon>
            <x-svg.exchange class="button__icon button__icon_big button__exchange-icon"></x-svg.exchange>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        x-on:click="setForm('post')"
        x-bind:class="activateButton('post')"
        color="dark"
        only-icon="true"
        title="Добавить публикацию">
        <x-slot:icon>
            <x-svg.edit class="button__icon button__icon_big button__edit-icon"></x-svg.edit>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        color="dark"
        only-icon="true"
        title="Добавить в список желаемого">
        <x-slot:icon>
            <x-svg.wishlist class="button__icon button__icon_big button__wishlist-icon"></x-svg.wishlist>
        </x-slot:icon>
    </x-ui.form.button>

    <x-ui.form.button
        color="dark"
        only-icon="true"
        title="Добавить в избранное">
        <x-slot:icon>
            <x-svg.star class="button__icon button__icon_big button__star-icon"></x-svg.star>
        </x-slot:icon>
    </x-ui.form.button>
</div>
