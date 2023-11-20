<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
        <x-common.content class="qa">
            <x-slot:sidebar>
                <nav class="content__sidebar-menu">
                    <x-ui.form.button
                        class="content__sidebar-link"
                        link="{{ route('rules') }}"
                        tag="a">
                        Правила сайта
                    </x-ui.form.button>
                    <x-ui.form.button
                        class="content__sidebar-link"
                        link="{{ route('qa') }}"
                        tag="a"
                        color="light">
                        Вопрос-ответ
                    </x-ui.form.button>
                    <x-ui.form.button
                        class="content__sidebar-link"
                        tag="a"
                        color="light">
                        Политика конфиденциальности
                    </x-ui.form.button>
                </nav>
            </x-slot:sidebar>

                <x-ui.title size="normal" indent="big">Вопрос-ответ</x-ui.title>
                <div class="content__main content__main_article">
                    <x-ui.accordion>
                        <x-ui.accordion.item>
                            <x-ui.accordion.title>Lorem ipsum dolor sit amet?</x-ui.accordion.title>
                            <x-ui.accordion.content>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                            </x-ui.accordion.content>
                        </x-ui.accordion.item>z

                        <x-ui.accordion.item color="light">
                            <x-ui.accordion.title>Aut delectus error eum iste suscipit?</x-ui.accordion.title>
                            <x-ui.accordion.content>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                                </p>
                            </x-ui.accordion.content>
                        </x-ui.accordion.item>

                        <x-ui.accordion.item>
                            <x-ui.accordion.title>Lorem ipsum dolor sit amet, consectetur adipisicing elit?</x-ui.accordion.title>
                            <x-ui.accordion.content>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                                </p>
                            </x-ui.accordion.content>
                        </x-ui.accordion.item>

                        <x-ui.accordion.item>
                            <x-ui.accordion.title>Amet cupiditate dignissimos hic ipsa?</x-ui.accordion.title>
                            <x-ui.accordion.content>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                                </p>                        </x-ui.accordion.content>
                        </x-ui.accordion.item>

                        <x-ui.accordion.item open>
                            <x-ui.accordion.title>Cupiditate dignissimos hic ipsa?</x-ui.accordion.title>
                            <x-ui.accordion.content>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                                </p>
                            </x-ui.accordion.content>
                        </x-ui.accordion.item>
                    </x-ui.accordion>
                </div>

        </x-common.content>
    </x-grid.container>

    @push('scripts')
    @endpush
</x-layouts.main>
