<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Post') }}</x-ui.title>
    <x-ui.card>
        <article class="post post_standard">
            <p>
                Lorem ipsum dolor sit amet, <a href="">consectetur</a> adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                <strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</strong> Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </p>

            <a href="{{ asset('/storage/test.jpg') }}" data-fancybox data-caption="Single image">
                <picture class="image image_standard image_align_left ui__image_1">
                    <source
                        type="image/webp"
                        srcset="
                                        {{ asset('/storage/test-300.webp') }} 300w,
                                        {{ asset('/storage/test-650.webp') }} 650w,
                                        {{ asset('/storage/test-800.webp') }} 800w,
                                        {{ asset('/storage/test-1200.webp') }} 1200w,
                                        {{ asset('/storage/test-1500.webp') }} 1500w,
                                        {{ asset('/storage/test.webp') }} 3000w,
                                    "
                        sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                    />
                    <img
                        src="{{ asset('/storage/test.jpg') }}"
                        srcset="
                                        {{ asset('/storage/test-300.jpg') }} 300w,
                                        {{ asset('/storage/test-650.jpg') }} 650w,
                                        {{ asset('/storage/test-800.jpg') }} 800w,
                                        {{ asset('/storage/test-1200.jpg') }} 1200w,
                                        {{ asset('/storage/test-1jpg') }} 1500w,
                                        {{ asset('/storage/test.jpg') }} 3000w,
                                    "
                        sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                        loading="lazy"
                        decoding="async"
                        alt="Test image"
                        title="Test image"
                    />
                </picture>
            </a>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </p>

            <div class="image image_standard image_align_right ui__image_2">
                <picture>
                    <source
                        type="image/webp"
                        srcset="
                                        {{ asset('/storage/test-300.webp') }} 300w,
                                        {{ asset('/storage/test-650.webp') }} 650w,
                                        {{ asset('/storage/test-800.webp') }} 800w,
                                        {{ asset('/storage/test-1200.webp') }} 1200w,
                                        {{ asset('/storage/test-1500.webp') }} 1500w,
                                        {{ asset('/storage/test.webp') }} 3000w,
                                    "
                        sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                    />
                    <img
                        src="{{ asset('/storage/test.jpg') }}"
                        srcset="
                                        {{ asset('/storage/test-300.jpg') }} 300w,
                                        {{ asset('/storage/test-650.jpg') }} 650w,
                                        {{ asset('/storage/test-800.jpg') }} 800w,
                                        {{ asset('/storage/test-1200.jpg') }} 1200w,
                                        {{ asset('/storage/test-1jpg') }} 1500w,
                                        {{ asset('/storage/test.jpg') }} 3000w,
                                    "
                        sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                        loading="lazy"
                        decoding="async"
                        alt="Test image"
                        title="Test image"
                    />
                </picture>
                <div class="image__caption">Image description</div>
            </div>
            {{--                    <img--}}
            {{--                        srcset="--}}
            {{--                            {{ asset('/storage/test-300.webp') }} 300w,--}}
            {{--                            {{ asset('/storage/test-650.webp') }} 650w,--}}
            {{--                            {{ asset('/storage/test-800.webp') }} 800w,--}}
            {{--                            {{ asset('/storage/test-1200.webp') }} 1200w,--}}
            {{--                            {{ asset('/storage/test-1500.webp') }} 1500w,--}}
            {{--                            {{ asset('/storage/test.webp') }} 3000w,--}}
            {{--                        "--}}
            {{--                        sizes="--}}
            {{--                          (max-width: 700px) 280px,--}}
            {{--                          (max-width: 1000px) 740px,--}}
            {{--                          (max-width: 1900px) 1500px,--}}
            {{--                          100vw--}}
            {{--                        "--}}
            {{--                        src="{{ asset('/storage/test.webp') }}"--}}
            {{--                        alt="">--}}
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </p>
            <blockquote>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </blockquote>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </p>
            <h3 class="title title_size_big title_indent_normal">Title in content</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </p>
            <ul>
                <li>Li test item</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
                <li>Li test item</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
            </ul>
            <h4 class="title title_size_normal title_indent_normal">Title in content</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </p>
            <ol>
                <li>Li test item</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
                <li>Li test item</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
                <li>Li test item</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
                <li>Li test item</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.</li>
                <li>Li test item Lorem ipsum dolor sit amet</li>
            </ol>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </p>


            <picture>
                <source
                    type="image/webp"
                    srcset="
                                        {{ asset('/storage/test-300.webp') }} 300w,
                                        {{ asset('/storage/test-650.webp') }} 650w,
                                        {{ asset('/storage/test-800.webp') }} 800w,
                                        {{ asset('/storage/test-1200.webp') }} 1200w,
                                        {{ asset('/storage/test-1500.webp') }} 1500w,
                                        {{ asset('/storage/test.webp') }} 3000w,
                                    "
                    sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                />
                <img
                    class="image image_standard image_align_center ui__image_3"
                    src="{{ asset('/storage/test.jpg') }}"
                    srcset="
                                        {{ asset('/storage/test-300.jpg') }} 300w,
                                        {{ asset('/storage/test-650.jpg') }} 650w,
                                        {{ asset('/storage/test-800.jpg') }} 800w,
                                        {{ asset('/storage/test-1200.jpg') }} 1200w,
                                        {{ asset('/storage/test-1jpg') }} 1500w,
                                        {{ asset('/storage/test.jpg') }} 3000w,
                                    "
                    sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </picture>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </p>

            <div class="table__wrapper">
                <table class="table table_color_nth table_color_td table_color_th">
                    <tr>
                        <th>Company</th>
                        <th>Q1</th>
                        <th>Q2</th>
                        <th>Q3</th>
                        <th>Q4</th>
                    </tr>
                    <tr>
                        <td>Microsoft</td>
                        <td>20.3</td>
                        <td>30.5</td>
                        <td>23.5</td>
                        <td>40.3</td>
                    </tr>
                    <tr>
                        <td>Google</td>
                        <td>50.2</td>
                        <td>40.63</td>
                        <td>45.23</td>
                        <td>39.3</td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>25.4</td>
                        <td>30.2</td>
                        <td>33.3</td>
                        <td>36.7</td>
                    </tr>
                    <tr>
                        <td>IBM</td>
                        <td>20.4</td>
                        <td>15.6</td>
                        <td>22.3</td>
                        <td>29.3</td>
                    </tr>
                </table>
            </div>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquam, assumenda corporis delectus dolor, dolore dolores dolorum ea eligendi ex fuga inventore magni, molestias odio quas saepe similique sunt tenetur.
            </p>

            <div class="table__wrapper">
                <table class="table">
                    <tr>
                        <th>Company</th>
                        <th>Q1</th>
                        <th>Q2</th>
                        <th>Q3</th>
                        <th>Q4</th>
                    </tr>
                    <tr>
                        <td>Microsoft</td>
                        <td>20.3</td>
                        <td>30.5</td>
                        <td>23.5</td>
                        <td>40.3</td>
                    </tr>
                    <tr>
                        <td>Google</td>
                        <td>50.2</td>
                        <td>40.63</td>
                        <td>45.23</td>
                        <td>39.3</td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>25.4</td>
                        <td>30.2</td>
                        <td>33.3</td>
                        <td>36.7</td>
                    </tr>
                    <tr>
                        <td>IBM</td>
                        <td>20.4</td>
                        <td>15.6</td>
                        <td>22.3</td>
                        <td>29.3</td>
                    </tr>
                </table>
            </div>
        </article>
    </x-ui.card>
</section>
