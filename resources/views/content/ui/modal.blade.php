<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Modal') }}</x-ui.title>

    <x-ui.card>
        <x-grid type="container">

            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                    <x-ui.form.group>
                        <x-ui.form.button
                            x-on:click.stop="modalHide = ! modalHide"
                            full_width="true">
                            Open Extra Small Modal
                        </x-ui.form.button>
                    </x-ui.form.group>
                    <x-ui.modal tag="section" ::class="modalHide ? '' : 'modal_show'">
                        <x-ui.modal.content
                            x-on:click.outside="modalHide = true"
                            size="extra_small">

                            <x-ui.modal.close x-on:click="modalHide = true">
                            </x-ui.modal.close>

                            <x-ui.modal.header>
                                <x-ui.title indent="normal">Header</x-ui.title>
                            </x-ui.modal.header>

                            <x-ui.modal.body>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                            </x-ui.modal.body>

                            <x-ui.modal.footer align_buttons="center">
                                <x-ui.form.button
                                    only_icon="true"
                                    indent="right">
                                    <x-svg.success class="button__icon button__icon_big button__edit-icon"></x-svg.success>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    x-on:click="modalHide = true"
                                    color="cancel"
                                    only_icon="true">
                                    <x-svg.cancel class="button__icon button__icon_big button__close-icon"></x-svg.cancel>
                                </x-ui.form.button>
                            </x-ui.modal.footer>
                        </x-ui.modal.content>
                    </x-ui.modal>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                    <x-ui.form.group>
                        <x-ui.form.button
                            x-on:click.stop="modalHide = ! modalHide"
                            color="info"
                            full_width="true">
                            Open Small Modal
                        </x-ui.form.button>
                    </x-ui.form.group>
                    <x-ui.modal tag="section" ::class="modalHide ? '' : 'modal_show'">
                        <x-ui.modal.content
                            x-on:click.outside="modalHide = true"
                            size="small">

                            <x-ui.modal.close x-on:click="modalHide = true">
                            </x-ui.modal.close>

                            <x-ui.modal.header>
                                <x-ui.title
                                    size="normal"
                                    indent="normal">
                                    Header
                                </x-ui.title>
                            </x-ui.modal.header>

                            <x-ui.modal.body>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                            </x-ui.modal.body>

                            <x-ui.modal.footer align_buttons="right">
                                <x-ui.form.button>
                                    Submit
                                </x-ui.form.button>

                                <x-ui.form.button
                                    x-on:click="modalHide = true"
                                    color="cancel"
                                    indent="left">
                                    Cancel
                                </x-ui.form.button>
                            </x-ui.modal.footer>
                        </x-ui.modal.content>
                    </x-ui.modal>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                    <x-ui.form.group>
                        <x-ui.form.button
                            x-on:click.stop="modalHide = ! modalHide"
                            color="warning"
                            full_width="true">
                            Open Normal Modal
                        </x-ui.form.button>
                    </x-ui.form.group>
                    <x-ui.modal tag="section" ::class="modalHide ? '' : 'modal_show'">
                        <x-ui.modal.content
                            x-on:click.outside="modalHide = true"
                            size="normal">

                            <x-ui.modal.close x-on:click="modalHide = true">
                            </x-ui.modal.close>

                            <x-ui.modal.header>
                                <x-ui.title
                                    size="normal"
                                    indent="normal">
                                    Header
                                </x-ui.title>
                            </x-ui.modal.header>

                            <x-ui.modal.body>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                            </x-ui.modal.body>

                            <x-ui.modal.footer align_buttons="right">
                                <x-ui.form.button>
                                    Submit
                                </x-ui.form.button>

                                <x-ui.form.button
                                    x-on:click="modalHide = true"
                                    color="cancel"
                                    indent="left">
                                    Cancel
                                </x-ui.form.button>
                            </x-ui.modal.footer>
                        </x-ui.modal.content>
                    </x-ui.modal>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                    <x-ui.form.group>
                        <x-ui.form.button
                            x-on:click.stop="modalHide = ! modalHide"
                            full_width="true">
                            Open Big Modal
                        </x-ui.form.button>
                    </x-ui.form.group>
                    <x-ui.modal tag="section" ::class="modalHide ? '' : 'modal_show'">
                        <x-ui.modal.content
                            x-on:click.outside="modalHide = true"
                            size="big">

                            <x-ui.modal.close x-on:click="modalHide = true">
                            </x-ui.modal.close>

                            <x-ui.modal.header>
                                <x-ui.title
                                    size="normal"
                                    indent="normal">
                                    Header
                                </x-ui.title>
                            </x-ui.modal.header>

                            <x-ui.modal.body>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                            </x-ui.modal.body>

                            <x-ui.modal.footer>
                                Footer Text
                            </x-ui.modal.footer>
                        </x-ui.modal.content>
                    </x-ui.modal>
                </div>
            </x-grid.col>

            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                    <x-ui.form.group>
                        <x-ui.form.button
                            x-on:click.stop="modalHide = ! modalHide"
                            color="warning"
                            full_width="true">
                            Open Large Modal
                        </x-ui.form.button>
                    </x-ui.form.group>
                    <x-ui.modal tag="section" ::class="modalHide ? '' : 'modal_show'">
                        <x-ui.modal.content
                            x-on:click.outside="modalHide = true"
                            size="large">

                            <x-ui.modal.close x-on:click="modalHide = true">
                            </x-ui.modal.close>

                            <x-ui.modal.header>
                                <x-ui.title
                                    size="normal"
                                    indent="normal">
                                    Header
                                </x-ui.title>
                            </x-ui.modal.header>

                            <x-ui.modal.body>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                            </x-ui.modal.body>

                            <x-ui.modal.footer align_buttons="left">
                                <x-ui.form.button
                                    indent="right">
                                    Submit
                                </x-ui.form.button>

                                <x-ui.form.button
                                    x-on:click="modalHide = true"
                                    color="cancel">
                                    Cancel
                                </x-ui.form.button>
                            </x-ui.modal.footer>
                        </x-ui.modal.content>
                    </x-ui.modal>
                </div>
            </x-grid.col>


            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <div x-data="{toastHide: true}">
                    <x-ui.form.group >
                        <x-ui.form.button
                            x-on:click.stop="toastHide = ! toastHide; setTimeout(() => toastHide = true, 3000)"
                            color="info"
                            full_width="true">
                            Show Toast
                        </x-ui.form.button>
                    </x-ui.form.group>
                    <x-ui.toast ::class="toastHide ? '' : 'toast_show'" >
                        <x-ui.message
                            class="ui__message"
                            type="info"
                            close="true">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                            non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                            veritatis vero voluptate!
                            <x-slot:close x-on:click="toastHide = true">
                            </x-slot:close>
                        </x-ui.message>
                    </x-ui.toast>
                </div>
            </x-grid.col>
        </x-grid>
    </x-ui.card>
</section>
