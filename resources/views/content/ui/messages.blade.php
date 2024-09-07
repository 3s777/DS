<section class="ui__section">

    <x-ui.title size="big" indent="big" >{{ __('Messages') }}</x-ui.title>

    <x-ui.card>
        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message Info') }}</x-ui.title>
        <x-ui.message class="ui__message" type="info">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
        </x-ui.message>

        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message Danger') }}</x-ui.title>
        <x-ui.message class="ui__message" type="danger">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
        </x-ui.message>

        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message Success') }}</x-ui.title>
        <x-ui.message class="ui__message">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
        </x-ui.message>

        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message Warning') }}</x-ui.title>
        <x-ui.message class="ui__message" type="warning">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
        </x-ui.message>

        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message Disabled') }}</x-ui.title>
        <x-ui.message class="ui__message" type="disabled">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
        </x-ui.message>

        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message Info with icon') }}</x-ui.title>
        <x-ui.message class="ui__message" type="info">
            <x-slot:icon class="message__icon_info">
                <x-svg.info class="message__info-icon"></x-svg.info>
            </x-slot:icon>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
        </x-ui.message>

        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message Danger with icon') }}</x-ui.title>
        <x-ui.message class="ui__message" type="danger">
            <x-slot:icon class="message__icon_danger">
                <x-svg.danger class="message__danger-icon"></x-svg.danger>
            </x-slot:icon>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
        </x-ui.message>

        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message Success with icon') }}</x-ui.title>
        <x-ui.message class="ui__message">
            <x-slot:icon class="message__icon_success">
                <x-svg.success class="message__success-icon"></x-svg.success>
            </x-slot:icon>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
        </x-ui.message>


        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message Warning with icon') }}</x-ui.title>
        <x-ui.message class="ui__message" type="warning">
            <x-slot:icon class="message__icon_warning">
                <x-svg.warning class="message__warning-icon"></x-svg.warning>
            </x-slot:icon>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
        </x-ui.message>

        <x-ui.title tag="h3" size="small" indent="normal" >{{ __('Message with close') }}</x-ui.title>
        <x-ui.message
            class="ui__message"
            type="info"
            x-show="show_message">
            <x-slot:icon class="message__icon_info">
                <x-svg.info class="message__info-icon"></x-svg.info>
            </x-slot:icon>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
            veritatis vero voluptate!
            <x-slot:close x-on:click="show_message = ! show_message"></x-slot:close>
        </x-ui.message>

    </x-ui.card>
</section>
