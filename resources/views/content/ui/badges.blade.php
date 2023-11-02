<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Badges') }}</x-ui.title>
    <x-ui.card>
        <x-grid type="container">

            <x-grid.col xl="2" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button class="ui__button_badge">
                        Badge round
                        <x-ui.badge
                            class="ui__badge_standard"
                            size="small">
                        </x-ui.badge>
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>
            <x-grid.col xl="2" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button class="ui__button_badge">
                        Badge round
                        <x-ui.badge
                            class="ui__badge_standard">
                        </x-ui.badge>
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>
            <x-grid.col xl="2" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button class="ui__button_badge">
                        Badge round
                        <x-ui.badge
                            class="ui__badge_standard"
                            size="big">
                        </x-ui.badge>
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button class="ui__button_badge" color="dark">
                        Badge round
                        <x-ui.badge
                            class="ui__badge_standard"
                            color="success"
                            size="big">
                        </x-ui.badge>
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button class="ui__button_badge" color="dark">
                        Badge number
                        <x-ui.badge
                            class="ui__badge_standard"
                            type="number"
                            color="success">
                            12
                        </x-ui.badge>
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="2" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.button class="ui__button_badge" color="dark">
                        Badge number
                        <x-ui.badge
                            class="ui__badge_standard"
                            type="number">
                            5
                        </x-ui.badge>
                    </x-ui.form.button>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <div class="image image_standard ui__image_badge">
                        <picture>
                            <source
                                type="image/webp"
                                srcset="
                                            {{ asset('/storage/test-300.webp') }} 300w,
                                            {{ asset('/storage/test-650.webp') }} 650w,

                                        "
                                sizes="
                                            (max-width: 700px) 280px,
                                            100vw
                                        "
                            />
                            <img
                                src="{{ asset('/storage/test-650.jpg') }}"
                                srcset="
                                            {{ asset('/storage/test-300.jpg') }} 300w,
                                            {{ asset('/storage/test-650.jpg') }} 650w,,
                                        "
                                sizes="
                                            (max-width: 700px) 280px,,
                                            100vw
                                        "
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </picture>
                        <div class="image__caption">Image description</div>
                        <x-ui.badge
                            type="ribbon"
                            ribbon_align="left">
                            Ribbon badge
                        </x-ui.badge>
                    </div>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <div class="image image_standard ui__badge_placeholder">
                        <x-ui.badge type="bookmark">
                            new
                        </x-ui.badge>
                        <x-ui.badge
                            type="ribbon"
                            ribbon_align="right"
                            color="success">
                            Ribbon badge
                        </x-ui.badge>
                        <x-ui.badge
                            class="ui__ribbon_test_1"
                            type="ribbon"
                            ribbon_align="right"
                            color="info">
                            Ribbon badge
                        </x-ui.badge>
                        <x-ui.badge
                            class="ui__ribbon_test_2"
                            type="ribbon"
                            ribbon_align="right"
                            color="warning">
                            Ribbon badge
                        </x-ui.badge>
                    </div>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <div class="image image_standard ui__badge_placeholder">
                        <x-ui.badge type="bookmark">
                            <x-svg.star class="badge__star"></x-svg.star>
                        </x-ui.badge>
                        <x-ui.badge
                            color="success"
                            type="bookmark"
                            bookmark_align="right">
                            new
                        </x-ui.badge>
                    </div>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="3" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.badge type="tag" color="dark">
                        Test label tag
                    </x-ui.badge>
                </x-ui.form.group>
            </x-grid.col>


        </x-grid>
    </x-ui.card>
</section>
