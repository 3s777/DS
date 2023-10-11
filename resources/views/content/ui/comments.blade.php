<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Comments') }}</x-ui.title>
    <x-ui.card>
        <x-grid>
            <x-grid.col xl="12">
                <x-ui.comments count="4">
                    <x-ui.comments.comment
                        class="test-class"
                        username="@i.sinica"
                        avatar_url="{{ asset('/storage/test-5.jpg') }}"
                        user_link="{{ route('ui') }}"
                        date="09.10.2023 10:43"
                        likes_count="13"
                        likes_status="active"
                    >
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                            commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                            mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                            totam voluptates.</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                            commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                            mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                            totam voluptates.</p>
                    </x-ui.comments.comment>

                    <x-ui.comments.comment
                        class="test-class"
                        type="answer"
                        username="Администратор сообщества"
                        avatar_url="{{ asset('/storage/test.jpg') }}"
                        user_link="{{ route('ui') }}"
                        date="10.10.2024 15:10"
                        likes_count="5"
                        likes_status="active"
                    >
                        <p>Lorem</p>
                    </x-ui.comments.comment>

                    <x-ui.comments.comment
                        class="test-class"
                        type="answer"
                        color="author"
                        username="Администратор сообщества"
                        avatar_url="{{ asset('/storage/test.jpg') }}"
                        user_link="{{ route('ui') }}"
                        date="10.10.2024 15:10"
                        likes_count="5"
                        likes_status="active"
                    >
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                            commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                            mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                            totam voluptates.</p>
                    </x-ui.comments.comment>

                    <x-ui.comments.comment
                        class="test-class"
                        username="@i.sinica"
                        avatar_url="{{ asset('/storage/test-5.jpg') }}"
                        user_link="{{ route('ui') }}"
                        date="09.10.2023 10:43"
                        likes_count="13"
                        likes_status="active"
                    >
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                            commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                            mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                            totam voluptates.</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                            commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                            mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                            totam voluptates.</p>
                    </x-ui.comments.comment>
                </x-ui.comments>
            </x-grid.col>
        </x-grid>
    </x-ui.card>
</section>
