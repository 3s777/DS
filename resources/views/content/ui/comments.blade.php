<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Comments') }}</x-ui.title>
    <x-ui.card>
        <x-grid>
            <x-grid.col xl="12">
                <x-ui.comments>
                    <x-ui.title
                        indent="normal">
                        {{ __('Comments') }}
                    </x-ui.title>
                    <div class="comment comments__item">
                        <div class="comment__avatar">
                            <img src="{{ asset('/storage/test-5.jpg') }}" alt="">
                        </div>
                        <div class="comment__content">
                            <div class="comment__header">
                                <div class="comment__username">
                                    <a class="comment__user-button button button_submit" href="">@i.sinica</a>
                                </div>
                                <div class="comment__date">09.10.2023 10:43</div>
                            </div>
                            <div class="comment__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                                    commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                                    mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                                    totam voluptates.</p>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                                    commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                                    mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                                    totam voluptates.</p>
                            </div>
                            <div class="comment__footer">
                                <x-ui.like
                                    class="comment__like"
                                    count="12"
                                    size="small"
                                    status="active"
                                    type="like">
                                    <x-svg.like class="like__icon"></x-svg.like>
                                </x-ui.like>
                                <a class="comment__reply" href="#">{{ __('Reply') }}</a>
                            </div>
                        </div>
                    </div>
                </x-ui.comments>







            </x-grid.col>

        </x-grid>
    </x-ui.card>
</section>
