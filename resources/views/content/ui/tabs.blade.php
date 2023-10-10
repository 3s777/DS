<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Tabs') }}</x-ui.title>
    <x-ui.card>
        <x-grid type="container">

            <x-grid.col xl="6" lg="6" md="6" sm="12">
                <x-ui.tabs>
                    <x-ui.tabs.header>
                        <x-ui.tabs.link>First</x-ui.tabs.link>
                        <x-ui.tabs.link>Second</x-ui.tabs.link>
                        <x-ui.tabs.link>Third</x-ui.tabs.link>
                    </x-ui.tabs.header>
                    <x-ui.tabs.content>
                        <x-ui.tabs.content-block class="post">
                            <h2 class="title title_indent_normal title_size_normal">First tab content</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias aperiam assumenda aut deserunt doloremque, fugit iusto libero, nostrum porro possimus quisquam? Iure, nisi!</p>
                        </x-ui.tabs.content-block>
                        <x-ui.tabs.content-block>
                            <h2 class="title title_indent_normal title_size_normal">Second tab content</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias.</p>
                        </x-ui.tabs.content-block>
                        <x-ui.tabs.content-block>
                            <h2 class="title title_indent_normal title_size_normal">Third tab content</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias aperiam assumenda aut deserunt doloremque, fugit iusto libero, nostrum porro possimus quisquam? Iure, nisi!</p>
                        </x-ui.tabs.content-block>
                    </x-ui.tabs.content>
                </x-ui.tabs>
            </x-grid.col>

            <x-grid.col xl="6" lg="6" md="6" sm="12">
                <x-ui.tabs>
                    <x-ui.tabs.header>
                        <x-ui.form.button
                            class="tabs__header-link tabs__header-link_button"
                            color="dark">
                            First
                        </x-ui.form.button>
                        <x-ui.tabs.link
                            button="true"
                            color="dark"
                            active="true">
                            Second
                        </x-ui.tabs.link>
                        <x-ui.tabs.link
                            button="true"
                            color="dark">
                            Third
                        </x-ui.tabs.link>
                    </x-ui.tabs.header>
                    <x-ui.tabs.content>
                        <x-ui.tabs.content-block>
                            <h2 class="title title_indent_normal title_size_normal">First button tab content</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias aperiam assumenda aut deserunt doloremque, fugit iusto libero, nostrum porro possimus quisquam? Iure, nisi!</p>
                        </x-ui.tabs.content-block>
                        <x-ui.tabs.content-block active="true">
                            <h2 class="title title_indent_normal title_size_normal">Buttons second tab</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias.</p>
                        </x-ui.tabs.content-block>
                        <x-ui.tabs.content-block>
                            <h2 class="title title_indent_normal title_size_normal">Third button tab content</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias aperiam assumenda aut deserunt doloremque, fugit iusto libero, nostrum porro possimus quisquam? Iure, nisi!</p>
                        </x-ui.tabs.content-block>
                    </x-ui.tabs.content>
                </x-ui.tabs>
            </x-grid.col>
        </x-grid>
    </x-ui.card>
</section>
