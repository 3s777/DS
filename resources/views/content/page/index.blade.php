<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
        <x-common.content class="rules">
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
                <x-ui.title size="normal" indent="big">Наши правила</x-ui.title>
                <div class="content__main content__main_article">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias amet autem culpa eligendi enim error iusto labore laborum magnam mollitia nam odio perferendis placeat possimus qui, quia recusandae repellat saepe velit voluptatibus. Cum debitis dolorem doloribus ipsam ipsum laudantium placeat provident quia saepe unde. A, animi asperiores aut beatae cumque earum error harum in, iste magni natus officiis praesentium quam quod repellendus reprehenderit rerum sint, soluta voluptas voluptates. Atque aut cum dolorem est fuga fugit id impedit inventore iusto laborum molestias mollitia natus perspiciatis possimus praesentium quasi quia quod recusandae rem saepe, sed similique sint sit tempora totam ullam voluptate.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias amet autem culpa eligendi enim error iusto labore laborum magnam mollitia nam odio perferendis placeat possimus qui, quia recusandae repellat saepe velit voluptatibus. Cum debitis dolorem doloribus ipsam ipsum laudantium placeat provident quia saepe unde. A, animi asperiores aut beatae cumque earum error harum in, iste magni natus officiis praesentium quam quod repellendus reprehenderit rerum sint, soluta voluptas voluptates. Atque aut cum dolorem est fuga fugit id impedit inventore iusto laborum molestias mollitia natus perspiciatis possimus praesentium quasi quia quod recusandae rem saepe, sed similique sint sit tempora totam ullam voluptate.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias amet autem culpa eligendi enim error iusto labore laborum magnam mollitia nam odio perferendis placeat possimus qui, quia recusandae repellat saepe velit voluptatibus. Cum debitis dolorem doloribus ipsam ipsum laudantium placeat provident quia saepe unde. A, animi asperiores aut beatae cumque earum error harum in, iste magni natus officiis praesentium quam quod repellendus reprehenderit rerum sint, soluta voluptas voluptates. Atque aut cum dolorem est fuga fugit id impedit inventore iusto laborum molestias mollitia natus perspiciatis possimus praesentium quasi quia quod recusandae rem saepe, sed similique sint sit tempora totam ullam voluptate.
                    </p>
                </div>
        </x-common.content>
    </x-grid.container>

    @push('scripts')
    @endpush
</x-layouts.main>
