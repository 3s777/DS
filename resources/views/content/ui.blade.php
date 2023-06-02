@extends('layouts.auth')

@section('title', __('UI'))

@section('content')
    <div class="container">
        <div class="content ui">

            <x-ui.title class="ui__title_big" tag="h2" size="large" >{{ __('UI examples') }}</x-ui.title>

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Heading') }}</x-ui.title>
                <x-ui.card>
                    <x-ui.title size="large" indent="big" >{{ __('Heading Large') }}</x-ui.title>
                    <x-ui.title size="big" indent="big" >{{ __('Heading Large') }}</x-ui.title>
                    <x-ui.title size="normal" indent="big" >{{ __('Heading Large') }}</x-ui.title>
                    <x-ui.title indent="big" >{{ __('Heading No Size') }}</x-ui.title>
                    <x-ui.title size="small" indent="big" >{{ __('Heading Large') }}</x-ui.title>
                    <x-ui.title size="extra_small" indent="big" >{{ __('Heading Large') }}</x-ui.title>
                </x-ui.card>
            </section>

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

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Grid') }}</x-ui.title>
                <x-ui.card>
                    <x-grid class="ui__grid">
                        <x-grid.col class="ui__col" xl="3" lg="4" md="6" sm="12">Column 4-3-6-12</x-grid.col>
                        <x-grid.col class="ui__col" xl="3" lg="4" md="6" sm="12" no-gap="true">Column 4-3-6-12</x-grid.col>
                        <x-grid.col class="ui__col" xl="3" lg="4" md="6" sm="12" no-gap="true">Column 4-3-6-12</x-grid.col>
                        <x-grid.col class="ui__col" xl="3" lg="4" md="6" sm="12">Column 4-3-6-12</x-grid.col>
                    </x-grid>

                    <x-grid class="ui__grid">
                        <x-grid.col class="ui__col" xl="2" lg="3" md="4" sm="6">Column 2-3-4-6</x-grid.col>
                        <x-grid.col class="ui__col" xl="2" lg="3" md="4" sm="6">Column 2-3-4-6</x-grid.col>
                        <x-grid.col class="ui__col" xl="2" lg="3" md="4" sm="6">Column 2-3-4-6</x-grid.col>
                        <x-grid.col class="ui__col" xl="2" lg="3" md="4" sm="6">Column 2-3-4-6</x-grid.col>
                        <x-grid.col class="ui__col" xl="2" lg="3" md="4" sm="6">Column 2-3-4-6</x-grid.col>
                        <x-grid.col class="ui__col" xl="2" lg="3" md="4" sm="6">Column 2-3-4-6</x-grid.col>
                    </x-grid>

                    <x-grid class="ui__grid">
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                        <x-grid.col class="ui__col" xl="1" lg="2" md="3" sm="4">Column 1-2-3-4</x-grid.col>
                    </x-grid>
                </x-ui.card>

            </section>

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Inputs') }}</x-ui.title>

                <x-ui.card class="card">
                    <x-grid type="container">
                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.title size="small" >{{ __('Text input') }}</x-ui.title>
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    :errors="$errors"
                                    placeholder="Enter here text"
                                    id="text"
                                    name="text"
                                    value="{{ old('text') }}"
                                    required
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.title size="small" >{{ __('Text input with error') }}</x-ui.title>

                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    class="input-text__field_error"
                                    :errors="$errors"
                                    id="text"
                                    name="text"
                                    value="{{ old('text') }}"
                                    placeholder="Test"
                                    required
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.title size="small" >{{ __('Datepicker') }}</x-ui.title>

                            <x-ui.form.group>
                                <x-ui.form.datepicker
                                    :errors="$errors"
                                    id="date"
                                    name="date"
                                    value="{{ old('date') }}"
                                    required>
                                </x-ui.form.datepicker>
                            </x-ui.form.group>
                        </x-grid.col>
                    </x-grid>

                    <x-ui.title size="small" >{{ __('Textarea') }}</x-ui.title>
                    <x-ui.form.group>
                        <x-ui.form.textarea
                            :errors="$errors"
                            id="textarea"
                            name="textarea"
                            placeholder="{{ __('Textarea placeholder') }}">
                            {{ old('textarea') }}
                        </x-ui.form.textarea>
                    </x-ui.form.group>

                    <x-ui.title size="small" >{{ __('Quill') }}</x-ui.title>
                    <x-ui.form.group>
                        <div id="editor">
                            <h1>Hello World!</h1>
                            <p>Some initial <strong>bold</strong> text</p>
                        </div>
                    </x-ui.form.group>

                    {{--<div id="editorjs"></div>--}}

                </x-ui.card>

            </section>

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Switchers') }}</x-ui.title>
                <x-ui.card>
                    <x-grid type="container">
                            <x-grid.col xl="3" lg="4" md="6" sm="12">
                                <x-ui.form.group>
                                    <x-ui.form.input-checkbox
                                        id="remember"
                                        name="remember"
                                        label="{{ __('Remember me') }}"
                                    >
                                    </x-ui.form.input-checkbox>
                                </x-ui.form.group>
                            </x-grid.col>

                            <x-grid.col xl="3" lg="4" md="6" sm="12">
                                <x-ui.form.group>
                                    <x-ui.form.switcher
                                        name="switcher1"
                                        label="{{ __('Switcher Off') }}"
                                    >
                                    </x-ui.form.switcher>
                                </x-ui.form.group>
                            </x-grid.col>

                            <x-grid.col xl="3" lg="4" md="6" sm="12">
                                <x-ui.form.group>
                                    <x-ui.form.switcher
                                        name="switcher2"
                                        label="{{ __('Switcher On') }}"
                                        checked
                                    >
                                    </x-ui.form.switcher>
                                </x-ui.form.group>
                            </x-grid.col>

                            <x-grid.col xl="3" lg="4" md="6" sm="12">
                                <x-ui.form.group>
                                    <x-ui.form.switcher
                                        name="switcher3"
                                        label="{{ __('Switcher Disabled') }}"
                                        disabled
                                    >
                                    </x-ui.form.switcher>
                                </x-ui.form.group>
                            </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <nav>
                                    <x-ui.form.radio
                                    id="a-opt"
                                    name="choice"
                                    label="radio switcher"
                                    >
                                    </x-ui.form.radio>

                                    <x-ui.form.radio
                                        id="b-opt"
                                        name="choice"
                                        label="radio switcher 2"
                                        checked
                                    >
                                    </x-ui.form.radio>

                                    <x-ui.form.radio
                                        id="c-opt"
                                        name="choice"
                                        label="radio switcher 3"
                                    >
                                    </x-ui.form.radio>

                                    <x-ui.form.radio
                                        id="c-opt"
                                        name="choice"
                                        label="radio switcher disabled"
                                        disabled
                                    >
                                    </x-ui.form.radio>
                                </nav>
                            </x-ui.form.group>
                        </x-grid.col>

                            <x-grid.col xl="9" lg="4" md="6" sm="12">
                                <x-ui.form.group>
                                    <x-ui.form.radio-button
                                        id="radio-1"
                                        name="radio"
                                        value="1"
                                        color="dark"
                                        indent="right"
                                        checked="true"
                                        label="{{ __('Radio button 1') }}">
                                    </x-ui.form.radio-button>

                                    <x-ui.form.radio-button
                                        id="radio-2"
                                        name="radio"
                                        value="2"
                                        color="dark"
                                        indent="right"
                                        label="{{ __('Radio button 2') }}">
                                    </x-ui.form.radio-button>

                                    <x-ui.form.radio-button
                                        id="radio-3"
                                        name="radio"
                                        value="3"
                                        color="dark"
                                        indent="right"
                                        label="{{ __('Radio button 3') }}">
                                    </x-ui.form.radio-button>

                                    <x-ui.form.radio-button
                                        id="radio-4"
                                        name="radio"
                                        value="4"
                                        color="disabled"
                                        indent="right"
                                        label="{{ __('Disabled') }}">
                                    </x-ui.form.radio-button>
                                </x-ui.form.group>

                                <x-ui.form.group>
                                    <x-ui.form.radio-group>

                                        <x-ui.form.radio-button
                                            class="radio-group__button"
                                            id="radio-11"
                                            name="radio"
                                            value="11"
                                            color="dark"
                                            checked="true"
                                            label_class="radio-group__label"
                                            label="{{ __('Radio button 1') }}">
                                        </x-ui.form.radio-button>

                                        <x-ui.form.radio-button
                                            class="radio-group__button"
                                            id="radio-12"
                                            name="radio"
                                            value="12"
                                            color="dark"
                                            label_class="radio-group__label"
                                            label="{{ __('Radio button 2') }}">
                                        </x-ui.form.radio-button>

                                        <x-ui.form.radio-button
                                            class="radio-group__button"
                                            id="radio-13"
                                            name="radio"
                                            value="13"
                                            color="dark"
                                            label_class="radio-group__label"
                                            label="{{ __('Radio button 3') }}">
                                        </x-ui.form.radio-button>

                                        <x-ui.form.radio-button
                                            class="radio-group__button"
                                            id="radio-14"
                                            name="radio"
                                            value="14"
                                            color="disabled"
                                            label_class="radio-group__label"
                                            label="{{ __('Disabled') }}">
                                        </x-ui.form.radio-button>

                                    </x-ui.form.radio-group>
                                </x-ui.form.group>
                            </x-grid.col>

                    </x-grid>
                </x-ui.card>
            </section>

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Select') }}</x-ui.title>
                <x-ui.card>
                    <x-grid type="container">
                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-libraries.choices
                                    class="choices-select-1"
                                    id="select-test"
                                    name="select-test"
                                    label="Choose something">
                                    <x-ui.form.option>Classic select</x-ui.form.option>
                                    <x-ui.form.option value="1">Test 1</x-ui.form.option>
                                    <x-ui.form.option value="2">Test 2</x-ui.form.option>
                                    <x-ui.form.option value="3">Test 3</x-ui.form.option>
                                </x-libraries.choices>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-libraries.choices
                                    class="choices-select-2"
                                    id="select-test-2"
                                    name="select-test-2"
                                    label="Choose something" multiple>
                                    <x-ui.form.option>Add multiple</x-ui.form.option>
                                    <x-ui.form.option value="1" selected>Test 1</x-ui.form.option>
                                    <x-ui.form.option value="2">Test2 test test</x-ui.form.option>
                                    <x-ui.form.option value="3">Test3 words test bigwordwidth</x-ui.form.option>
                                </x-libraries.choices>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-libraries.choices
                                    class="choices-select-3"
                                    id="select-test-3"
                                    name="select-test-3"
                                    label="Choose something">
                                    <x-ui.form.option>Select with search</x-ui.form.option>
                                    <x-ui.form.option value="1">Test 1</x-ui.form.option>
                                    <x-ui.form.option value="2">Test 2</x-ui.form.option>
                                    <x-ui.form.option value="3">Test 3</x-ui.form.option>
                                </x-libraries.choices>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-libraries.choices
                                    class="choices-select-4"
                                    id="select-test-4"
                                    name="select-test-4"
                                    label="Choose something"
                                    input="true"
                                    value="{{ old('text') }}"
                                    required >
                                </x-libraries.choices>
                            </x-ui.form.group>
                        </x-grid.col>
                    </x-grid>
                </x-ui.card>
            </section>

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Buttons') }}</x-ui.title>
                <x-ui.card>
                    <x-grid type="container" class="grid grid_container">
                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true">
                                    {{ __('Submit') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true"
                                    color="cancel">
                                    {{ __('Cancel') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true"
                                    color="disabled"
                                    disabled>
                                    {{ __('Disabled') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true"
                                    color="light">
                                    {{ __('Light') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true"
                                    color="dark">
                                    {{ __('Dark') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true">
                                    <x-slot:icon class="button__icon-wrapper_submit">
                                        <x-svg.success class="button__submit-icon"></x-svg.success>
                                    </x-slot:icon>
                                    {{ __('With icon') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true"
                                    color="cancel">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.cancel class="button__cancel-icon"></x-svg.cancel>
                                    </x-slot:icon>
                                    {{ __('With icon') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true"
                                    color="dark">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.warning class="button__cancel-icon"></x-svg.warning>
                                    </x-slot:icon>
                                    {{ __('Dark') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true">
                                    {{ __('Normal size') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="6" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true">
                                    {{ __('Full width button') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button>
                                    {{ __('Content width button') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button>
                                    <x-slot:icon class="button__icon-wrapper_submit">
                                        <x-svg.success class="button__submit-icon"></x-svg.success>
                                    </x-slot:icon>
                                    {{ __('Content width button') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    size="small">
                                    {{ __('Small size') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true"
                                    size="big">
                                    {{ __('Big size') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="2" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true"
                                    color="cancel"
                                    icon_size="big"
                                    size="big">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.cancel class="button__cancel-icon"></x-svg.cancel>
                                    </x-slot:icon>
                                    {{ __('Big size') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    full_width="true"
                                    size="large">
                                    {{ __('Large size') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button
                                    tag="a"
                                    link="/"
                                    full_width="true"
                                    color="cancel"
                                    icon_size="large"
                                    size="large">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.cancel class="button__cancel-icon"></x-svg.cancel>
                                    </x-slot:icon>
                                    {{ __('Large size') }}
                                </x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="6" lg="6" md="6" sm="12">
                            <x-ui.form.group class="ui__form-group_buttons">

                                <x-ui.form.button
                                    color="info"
                                    only_icon="true"
                                    only_icon_size="extra-small">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.view class="button__icon button__icon_extra-small button__view-icon"></x-svg.view>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="warning"
                                    only_icon="true"
                                    only_icon_size="extra-small">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.edit class="button__icon button__icon_extra-small button__edit-icon"></x-svg.edit>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="cancel"
                                    only_icon="true"
                                    only_icon_size="extra-small">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.close class="button__icon button__icon_extra-small button__close-icon"></x-svg.close>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="info"
                                    only_icon="true"
                                    only_icon_size="small">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.view class="button__icon button__icon_small button__view-icon"></x-svg.view>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="warning"
                                    only_icon="true"
                                    only_icon_size="small">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.edit class="button__icon button__icon_small button__edit-icon"></x-svg.edit>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="cancel"
                                    only_icon="true"
                                    only_icon_size="small">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.close class="button__icon button__icon_small button__close-icon"></x-svg.close>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="info"
                                    only_icon="true">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.view class="button__icon button__view-icon"></x-svg.view>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="cancel"
                                    only_icon="true">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.close class="button__icon button__close-icon"></x-svg.close>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="warning"
                                    only_icon="true"
                                    only_icon_size="big">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.edit class="button__icon button__icon_big button__edit-icon"></x-svg.edit>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="cancel"
                                    only_icon="true"
                                    only_icon_size="big">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.close class="button__icon button__icon_big button__close-icon"></x-svg.close>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="info"
                                    only_icon="true"
                                    only_icon_size="large">
                                    <x-slot:icon class="button__icon-wrapper_cancel">
                                        <x-svg.cancel class="button__icon button__icon_large button__close-icon"></x-svg.cancel>
                                    </x-slot:icon>
                                </x-ui.form.button>

                                <x-ui.form.button
                                    tooltip="true"
                                    color="info">
                                    ?
                                </x-ui.form.button>

                                <x-ui.form.button
                                    tooltip="true"
                                    tooltip_size="extra_small">
                                    ?
                                </x-ui.form.button>

                                <x-ui.form.button
                                    color="cancel"
                                    tooltip="true"
                                    tooltip_size="big">
                                    ?
                                </x-ui.form.button>

                            </x-ui.form.group>
                        </x-grid.col>

                    </x-grid>
                </x-ui.card>
            </section>



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


            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Popover') }}</x-ui.title>

                <x-ui.card>
                    <x-grid type="container">
                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <div class="ui__item-wrapper">
                                <x-ui.popover
                                    class="ui__popover"
                                    content_class="popover__content_test"
                                    title="{{ __('Popover title') }}"
                                    tail="none">
                                    Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                </x-ui.popover>
                            </div>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <div class="ui__item-wrapper">
                                <x-ui.popover
                                    class="ui__popover"
                                    content_class="popover__content_test"
                                    title="{{ __('Popover title') }}">
                                    Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                    <x-slot:close x-on:click="show_message = ! show_message">
                                        <x-svg.close class="popover__close-icon"></x-svg.close>
                                    </x-slot:close>
                                </x-ui.popover>
                            </div>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <div class="ui__item-wrapper">
                                <x-ui.popover
                                    class="ui__popover"
                                    content_class="popover__content_test"
                                    title="{{ __('Popover title') }}"
                                    tail="left">
                                    Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                    <x-slot:close x-on:click="show_message = ! show_message">
                                        <x-svg.close class="popover__close-icon"></x-svg.close>
                                    </x-slot:close>
                                </x-ui.popover>
                            </div>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <div class="ui__item-wrapper">
                                <x-ui.popover
                                    class="ui__popover"
                                    content_class="popover__content_test"
                                    title="{{ __('Popover title') }}"
                                    tail="right">
                                    Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                    <x-slot:close x-on:click="show_message = ! show_message">
                                        <x-svg.close class="popover__close-icon"></x-svg.close>
                                    </x-slot:close>
                                </x-ui.popover>
                            </div>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <div class="ui__item-wrapper">
                                <x-ui.popover
                                    class="ui__popover"
                                    content_class="popover__content_test"
                                    title="{{ __('Popover title') }}">
                                    Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                    <x-slot:footer>
                                        <x-ui.popover.buttons align="center">
                                            <x-ui.form.button class="popover__button" size="small">Submit</x-ui.form.button>
                                            <x-ui.form.button class="popover__button" color="cancel" size="small">Cancel</x-ui.form.button>
                                        </x-ui.popover.buttons>
                                    </x-slot:footer>
                                    <x-slot:close x-on:click="show_message = ! show_message">
                                        <x-svg.close class="popover__close-icon"></x-svg.close>
                                    </x-slot:close>
                                </x-ui.popover>
                            </div>
                        </x-grid.col>

                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <div class="ui__item-wrapper">
                                <x-ui.popover
                                    class="ui__popover"
                                    content_class="popover__content_test"
                                    title="{{ __('Popover title') }}">
                                    Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                    <x-slot:footer>
                                        <x-ui.popover.buttons>
                                            <x-ui.form.button class="popover__button" size="small">Submit</x-ui.form.button>
                                            <x-ui.form.button class="popover__button" color="cancel" size="small">Cancel</x-ui.form.button>
                                        </x-ui.popover.buttons>
                                    </x-slot:footer>
                                    <x-slot:close x-on:click="show_message = ! show_message">
                                        <x-svg.close class="popover__close-icon"></x-svg.close>
                                    </x-slot:close>
                                </x-ui.popover>
                            </div>
                        </x-grid.col>

                            <x-grid.col xl="3" lg="4" md="6" sm="12">
                                <div class="ui__item-wrapper">
                                    <div class="ui__popover-test" x-data="{ testPopoverHidden: true }">
                                        <x-ui.form.button x-on:click.stop="testPopoverHidden = ! testPopoverHidden">Click me for popover</x-ui.form.button>
                                        <x-ui.popover
                                            x-on:click.outside="testPopoverHidden = true" ::class="testPopoverHidden ? '' : 'popover_visible'"
                                            class="popover_hidden ui__popover_visible"
                                            content_class="popover__content_test"
                                            title="{{ __('Popover title') }}"
                                            tail="left">
                                            Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                            <x-slot:close x-on:click="testPopoverHidden = true">
                                                <x-svg.close class="popover__close-icon"></x-svg.close>
                                            </x-slot:close>
                                        </x-ui.popover>
                                    </div>
                                </div>
                            </x-grid.col>

                            <x-grid.col xl="3" lg="4" md="6" sm="12">
                                <div class="ui__item-wrapper">
                                    <x-ui.form.button
                                        class="tooltip_trigger"
                                        color="info"
                                        tooltip="true"
                                        data-tooltip="tooltip_1">
                                        ?
                                    </x-ui.form.button>
                                    <x-ui.tooltip
                                        class="tooltip_1"
                                        id="tooltip">
                                        Big tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip
                                    </x-ui.tooltip>

                                    <x-ui.form.button
                                        class="tooltip_trigger"
                                        color="cancel"
                                        tooltip_size="big"
                                        tooltip="true"
                                        data-tooltip="tooltip_2">
                                        ?
                                    </x-ui.form.button>
                                    <x-ui.tooltip
                                        class="tooltip_2"
                                        id="tooltip2">
                                        Big tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip
                                    </x-ui.tooltip>

                                    <x-ui.form.button
                                        class="tooltip_trigger"
                                        tooltip_size="extra-small"
                                        tooltip="true"
                                        data-tooltip="tooltip_3">
                                        ?
                                    </x-ui.form.button>
                                    <x-ui.tooltip
                                        class="tooltip_3"
                                        id="tooltip3">
                                        Big tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip
                                    </x-ui.tooltip>
                                </div>
                            </x-grid.col>

                    </x-grid>
                </x-ui.card>
            </section>

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

                    </x-grid>
                </x-ui.card>
            </section>

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Tabulator') }}</x-ui.title>

                <x-ui.card>
                    <table id="example-table">
                        <thead>
                        <tr>
                            <th width="200">Name</th>
                            <th width="100">Age</th>
                            <th>Gender</th>
                            <th>Height</th>
                            <th>Favourite Color</th>
                            <th width="140">Date of Birth</th>
                            <th width="140">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Billy Bob</td>
                            <td>12</td>
                            <td>male</td>
                            <td>1</td>
                            <td>red</td>
                            <td></td>
                            <td>
                                <div class="ui__table-buttons">
                                    <div class="button button_icon button_info button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.view class="button__icon button__icon_small"></x-svg.view>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.close class="button__icon button__icon_small"></x-svg.close>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Mary May</td>
                            <td>1</td>
                            <td>female</td>
                            <td>2</td>
                            <td>blue</td>
                            <td>14/05/1982</td>
                            <td>
                                <div class="ui__table-buttons">
                                    <div class="button button_icon button_info button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.view class="button__icon button__icon_small"></x-svg.view>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.close class="button__icon button__icon_small"></x-svg.close>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Billy Bob</td>
                            <td>12</td>
                            <td>male</td>
                            <td>1</td>
                            <td>red</td>
                            <td></td>
                            <td>
                                <div class="ui__table-buttons">
                                    <div class="button button_icon button_info button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.view class="button__icon button__icon_small"></x-svg.view>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.close class="button__icon button__icon_small"></x-svg.close>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Mary May</td>
                            <td>1</td>
                            <td>female</td>
                            <td>2</td>
                            <td>blue</td>
                            <td>14/05/1982</td>
                            <td>
                                <div class="ui__table-buttons">
                                    <div class="button button_icon button_info button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.view class="button__icon button__icon_small"></x-svg.view>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.close class="button__icon button__icon_small"></x-svg.close>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Billy Bob</td>
                            <td>12</td>
                            <td>male</td>
                            <td>1</td>
                            <td>red</td>
                            <td></td>
                            <td>
                                <div class="ui__table-buttons">
                                    <div class="button button_icon button_info button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.view class="button__icon button__icon_small"></x-svg.view>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.close class="button__icon button__icon_small"></x-svg.close>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Mary May</td>
                            <td>1</td>
                            <td>female</td>
                            <td>2</td>
                            <td>blue</td>
                            <td>14/05/1982</td>
                            <td>
                                <div class="ui__table-buttons">
                                    <div class="button button_icon button_info button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.view class="button__icon button__icon_small"></x-svg.view>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.edit class="button__icon button__icon_small"></x-svg.edit>
                                        </div>
                                    </div>

                                    <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                        <div class="button__icon-wrapper">
                                            <x-svg.close class="button__icon button__icon_small"></x-svg.close>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </x-ui.card>
            </section>

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

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Accordion') }}</x-ui.title>

                <x-ui.card>
                    <x-ui.accordion>
                        <x-ui.accordion.item>
                            <x-ui.accordion.title>Lorem ipsum dolor sit amet?</x-ui.accordion.title>
                            <x-ui.accordion.content>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                            </x-ui.accordion.content>
                        </x-ui.accordion.item>

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
                </x-ui.card>
            </section>

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Swiper') }}</x-ui.title>

                <x-ui.card>

                    <x-libraries.swiper class="swiper ui__swiper">

                                <x-libraries.swiper.slide>
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>
                                <x-libraries.swiper.slide>
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test-2.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>
                                <x-libraries.swiper.slide>
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test-3.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>
                                <x-libraries.swiper.slide>
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test-4.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>
                                <x-libraries.swiper.slide>
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test-5.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>

                            <x-slot:pagination class="swiper-pagination_1"></x-slot:pagination>
                            <x-slot:navigation>1</x-slot:navigation>

                    </x-libraries.swiper>

                    <x-libraries.swiper type="full">

                                <x-libraries.swiper.slide class="ui__test-swiper-slide">
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>
                                <x-libraries.swiper.slide class="ui__test-swiper-slide">
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test-2.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>
                                <x-libraries.swiper.slide class="ui__test-swiper-slide">
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test-3.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>
                                <x-libraries.swiper.slide class="ui__test-swiper-slide">
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test-4.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>
                                <x-libraries.swiper.slide class="ui__test-swiper-slide">
                                    <img
                                        class="swiper__img"
                                        src="{{ asset('/storage/test-5.jpg') }}"
                                        loading="lazy"
                                        decoding="async"
                                        alt="Test image"
                                        title="Test image"
                                    />
                                </x-libraries.swiper.slide>

                            <x-slot:pagination class="swiper-pagination_2"></x-slot:pagination>
                            <x-slot:navigation></x-slot:navigation>

                    </x-libraries.swiper>
                </x-ui.card>
            </section>

            <section class="ui__section">
                <x-ui.title size="big" indent="big" >{{ __('Filepond') }}</x-ui.title>
                <x-ui.card>
                    <x-grid>
                        <x-grid.col xl="3" lg="6" md="6" sm="12">
                            <x-libraries.filepond
                                    class="filepond1"
                                    name="filepond"
                                    accept="image/png, image/jpeg, image/gif"
                                    multiple>
                            </x-libraries.filepond>
                        </x-grid.col>
                        <x-grid.col xl="3" lg="6" md="6" sm="12">
                            <x-libraries.filepond
                                class="filepond2"
                                name="filepond"
                                multiple
                                data-allow-reorder="true"
                                data-max-file-size="3MB"
                                data-max-files="3">
                            </x-libraries.filepond>
                        </x-grid.col>
                        <x-grid.col xl="2" lg="6" md="6" sm="12">
                            <x-libraries.filepond
                                class="filepond3"
                                name="filepond"
                                accept="image/png, image/jpeg, image/gif"
                                data-allow-reorder="true"
                                data-max-file-size="3MB">
                            </x-libraries.filepond>
                        </x-grid.col>
                    </x-grid>
                </x-ui.card>
            </section>
        </div>
    </div>

@endsection
@push('scripts')

    <script type="module">
        const element1 = document.querySelector('.choices-select-1');
        const choices1 = new Choices(element1, {
            itemSelectText: '',
            searchEnabled: false,
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element2 = document.querySelector('.choices-select-2');
        const choices2 = new Choices(element2, {
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element3 = document.querySelector('.choices-select-3');
        const choices3 = new Choices(element3, {
            itemSelectText: '',
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element4 = document.querySelector('.choices-select-4');
        const choices4 = new Choices(element4, {
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Input with items',
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        // const editor = new EditorJS({
        //     /**
        //      * Id of Element that should contain Editor instance
        //      */
        //     holder: 'editorjs',
        // })

        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['clean']                                         // remove formatting button
        ];

        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'
        });

        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });


        //create Tabulator on DOM element with id "example-table"
        var table = new Tabulator("#example-table", {
            layout:"fitColumns",
            rowHeight:'auto',
            footerElement:"<button class='button button_submit'>Custom Button</button class='button button_submit'>",
            responsiveLayout:"collapse",  //fit columns to width of table (optional)
            columns:[
                {
                    title: "Name"
                },
                {
                    title: "Age"
                },
                {
                    title: "Gender"
                },
                {
                    title: "Height"
                },
                {
                    title: "Favourite Color"
                },
                {
                    title: "Date of Birth"
                },
                {
                    title: "Edit",
                    formatter: (cell) => cell.getValue()
                },
            ],
        });

        //trigger an alert message when the row is clicked
        table.on("rowClick", function(e, row){
            alert("Row " + row.getData().id + " Clicked!!!!");
        });

        const swiper = new Swiper('.swiper__carousel', {
            // Optional parameters
            direction: 'horizontal',
            spaceBetween: 16,
            slidesPerView: 1,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination_1',
                clickable: true
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            breakpoints: {
                768: {
                    slidesPerView: 3,
                },
                576: {
                    slidesPerView: 2,
                },
            }


        });

        const swiperFull = new Swiper('.swiper__full', {
            // Optional parameters
            direction: 'horizontal',
            slidesPerView: 1,
            height: "300px",

            // If we need pagination
            pagination: {
                el: '.swiper-pagination_2',
                clickable: true
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },


        });

        const inputElement = document.querySelector('.filepond1');
        const pond = FilePond.create(inputElement, {
            credits: false,
            labelIdle: '{{ __('Перетащите файлы или') }} <span class="filepond--label-action"> {{ __('загрузите') }}</span>'
        });

        const inputElement2 = document.querySelector('.filepond2');
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginImageCrop,
            FilePondPluginImageResize,
            FilePondPluginImageTransform,
        );
        const pond2 = FilePond.create(inputElement2, {
            credits: false,
            labelIdle: '{{ __('Перетащите файлы или') }} <span class="filepond--label-action"> {{ __('загрузите') }}</span>',
            labelMaxFileSizeExceeded: 'Файл слишком большой',
            labelMaxFileSize: 'Максимальный размер {filesize}',
            labelFileLoading: 'Загрузка',
            labelTapToCancel: 'отменить',
            labelFileWaitingForSize: 'подождите'
        });


        const inputElement3 = document.querySelector('.filepond3');
        const pond3 = FilePond.create(inputElement3, {
            credits: false,
            labelIdle: '{{ __('Перетащите файлы или') }} <span class="filepond--label-action"> {{ __('загрузите') }}</span>',
            labelMaxFileSizeExceeded: 'Файл слишком большой',
            labelMaxFileSize: 'Максимальный размер {filesize}',
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
        });

    </script>
@endpush
