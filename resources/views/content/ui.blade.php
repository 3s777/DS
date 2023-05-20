@extends('layouts.auth')

@section('title', __('UI'))

@section('content')
    <div class="container">

    <div class="content ui">

        <h1 class="title title_size_large ui__title_big">UI examples</h1>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Heading') }}</h2>
            <div class="card">
                <h3 class="title title_size_large title_indent_big">Heading Large</h3>
                <h3 class="title title_indent_big">Heading Standard</h3>
                <h3 class="title title_size_big title_indent_big">Heading Big</h3>
                <h3 class="title title_size_normal title_indent_big">Heading Normal</h3>
                <h3 class="title title_size_small title_indent_big">Heading Small</h3>
                <h3 class="title title_size_extra_small title_indent_big">Heading Extra Small</h3>
            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Post') }}</h2>
            <div class="card">
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
            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Grid') }}</h2>
            <div class="card">
                <div class="grid ui__grid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ui__col">Column 4-3-6-12</div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ui__col">Column 4-3-6-12</div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ui__col">Column 4-3-6-12</div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ui__col">Column 4-3-6-12</div>
                    </div>
                </div>

                <div class="grid ui__grid">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 ui__col">Column 2-3-4-6</div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 ui__col">Column 2-3-4-6</div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 ui__col">Column 2-3-4-6</div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 ui__col">Column 2-3-4-6</div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 ui__col">Column 2-3-4-6</div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 ui__col">Column 2-3-4-6</div>
                    </div>
                </div>

                <div class="grid ui__grid">
                    <div class="row">
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                        <div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 ui__col">Column 1-2-3-4</div>
                    </div>
                </div>
            </div>

        </section>




        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Inputs') }}</h2>

            <div class="card">
                <div class="grid grid_c">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <h3 class="title title_size_small">Text input</h3>
                            <div class="form-group">
                                <div class="input-text">
                                    <input class="input-text__field"
                                           id="text" type="text" name="text"
                                           value="{{ old('text') }}" required autocomplete="text">
                                    <label class="input-text__label" for="text">{{ __('Text') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <h3 class="title title_size_small">Text input with error</h3>
                            <div class="form-group">
                                <div class="input-text">
                                    <input class="input-text__field  input-text__field_error"
                                           id="text" type="text" name="text"
                                           value="{{ old('text') }}" required autocomplete="text">
                                    <label class="input-text__label" for="text">{{ __('Text') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <h3 class="title title_size_small">Datepicker</h3>
                            <div class="form-group">
                                <div class="datepicker">
                                    <label class="datepicker__label" for="date">{{ __('Select date') }}</label>
                                    <input class="datepicker__field"
                                           id="date" type="date" name="date"
                                           value="{{ old('text') }}" required >
                                </div>
                            </div>
                        </div>

                    </div>
                </div>






                <h3 class="title title_size_small">Textarea</h3>
                <div class="form-group">
                    <div class="textarea">
                        <textarea class="textarea__field" placeholder="Description for textarea" name="" id="textarea"></textarea>
                        <label class="textarea__label" for="textarea">Description for textarea</label>
                    </div>
                </div>

                <h3 class="title title_size_small">Quill</h3>
                <div class="form-group">
                    <div id="editor">
                        <h1>Hello World!</h1>
                        <p>Some initial <strong>bold</strong> text</p>
                        <p><br></p>
                    </div>
                </div>


                {{--<div id="editorjs"></div>--}}

            </div>

        </section>


        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Switchers') }}</h2>
            <div class="card">
                <div class="grid grid_c">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="input-checkbox">
                                    <input class="input-checkbox__field" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="input-checkbox__label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="switcher">
                                    <input class="switcher__checkbox" type="checkbox">
                                    <span class="switcher__button"></span>
                                    <span class="switcher__label">Switcher Off</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="switcher">
                                    <input class="switcher__checkbox" type="checkbox" checked>
                                    <span class="switcher__button"></span>
                                    <span class="switcher__label">Switcher On</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="switcher">
                                    <input class="switcher__checkbox" type="checkbox" disabled>
                                    <span class="switcher__button"></span>
                                    <span class="switcher__label">Switcher Disabled</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <nav>
                                    <div class="radio">
                                        <input class="radio__input" type="radio" name="choice" id="a-opt" />
                                        <label class="radio__label" for="a-opt">radio switcher</label>
                                    </div>

                                    <div class="radio">
                                        <input class="radio__input" type="radio" name="choice" id="b-opt" checked />
                                        <label class="radio__label" for="b-opt">radio switcher 2</label>
                                    </div>

                                    <div class="radio">
                                        <input class="radio__input" type="radio" name="choice" id="c-opt" />
                                        <label class="radio__label" for="c-opt" >radio switcher 3</label>
                                    </div>

                                    <div class="radio">
                                        <input class="radio__input" type="radio" name="choice" id="d-opt" disabled />
                                        <label class="radio__label" for="d-opt">radio switcher disabled</label>
                                    </div>
                                </nav>
                            </div>
                        </div>


                        <div class="col-xl-9 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="radio-button radio-button_indent_right">
                                    <input class="radio-button__input" id="radio-1" type="radio" name="radio" value="1" checked>
                                    <label class="radio-button__label button button_dark" for="radio-1">Radio button 1</label>
                                </div>

                                <div class="radio-button radio-button_indent_right">
                                    <input class="radio-button__input" id="radio-2" type="radio" name="radio" value="2">
                                    <label class="radio-button__label button button_dark" for="radio-2">Radio button 2</label>
                                </div>

                                <div class="radio-button radio-button_indent_right">
                                    <input class="radio-button__input" id="radio-3" type="radio" name="radio" value="3">
                                    <label class="radio-button__label button button_dark" for="radio-3">Radio button 3</label>
                                </div>

                                <div class="radio-button">
                                    <input class="radio-button__input" id="radio-4" type="radio" name="radio" value="4" disabled>
                                    <label class="radio-button__label button button_disabled" for="radio-4">Disabled</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="radio-group">
                                    <div class="radio-group__button">
                                        <input class="radio-group__input" id="radio-11" type="radio" name="radio1" value="1" checked>
                                        <label class="radio-group__label button button_dark" for="radio-11">Radio button 1</label>
                                    </div>
                                    <div class="radio-group__button">
                                        <input class="radio-group__input" id="radio-12" type="radio" name="radio1" value="2">
                                        <label class="radio-group__label button button_dark" for="radio-12">Radio button 2</label>
                                    </div>
                                    <div class="radio-group__button">
                                        <input class="radio-group__input" id="radio-13" type="radio" name="radio1" value="3">
                                        <label class="radio-group__label button button_dark" for="radio-13">Radio button 3</label>
                                    </div>
                                    <div class="radio-group__button">
                                        <input class="radio-group__input" id="radio-14" type="radio" name="radio1" value="4" disabled>
                                        <label class="radio-group__label button button_disabled" for="radio-14">Disabled</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Select') }}</h2>
            <div class="card">
                <div class="grid grid_c">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="choices-block">
                                    <label class="choices-block__label" for="select-test">Choose something</label>
                                    <select class="choices-select-1" id="select-test" name="select-test" >
                                        <option value="">Classic select</option>
                                        <option value="1">Test1</option>
                                        <option value="2">Test2</option>
                                        <option value="3">Test3</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="choices-block">
                                    <label class="choices-block__label" for="select-test">Choose something</label>
                                    <select class="choices-select-2" name="select-test" multiple >
                                        <option value="">Add multiple</option>
                                        <option value="1" selected>Test1</option>
                                        <option value="2">Test2 test test</option>
                                        <option value="3">Test3 words test bigwordwidth</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="choices-block">
                                    <label class="choices-block__label" for="select-test">Choose something</label>
                                    <select class="choices-select-3" id="select-test" name="select-test" >
                                        <option value="">Select with search</option>
                                        <option value="1">Test1</option>
                                        <option value="2">Test2</option>
                                        <option value="3">Test3</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="choices-block">
                                    <label class="choices-block__label" for="select-test">Choose something</label>
                                    <input class="choices-select-4"
                                           id="text" type="text" name="text" placeholder="Input with items"
                                           value="{{ old('text') }}" required >

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Buttons') }}</h2>
            <div class="card">
                <div class="grid grid_c">
                    <div class="row">
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="button button_submit button_full_width">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <input class="button button_cancel button_full_width" type="submit" value="{{ __('Cancel') }}">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="button button_disabled button_full_width">
                                    {{ __('Disabled') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="button button_full_width">
                                    {{ __('Light') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="button button_dark button_full_width">
                                    {{ __('Dark') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="button button_submit button_icon button_full_width">
                                    <div class="button__icon-wrapper button__icon-wrapper_submit">
                                        @include('inline-svg/success', ['class' => 'button__submit-icon'])
                                    </div>
                                    {{ __('With icon') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="button button_cancel button_icon button_full_width">
                                    <div class="button__icon-wrapper button__icon-wrapper_cancel">
                                        @include('inline-svg/cancel', ['class' => 'button__cancel-icon'])
                                    </div>
                                    {{ __('With icon') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="button button_dark button_icon button_full_width">
                                    <div class="button__icon-wrapper button__icon-wrapper_cancel">
                                        @include('inline-svg/warning', ['class' => 'button__cancel-icon'])
                                    </div>
                                    {{ __('Dark') }}
                                </button>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <a class="button button_submit button_full_width">
                                    {{ __('Normal size') }}
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_submit button_full_width">
                                    {{ __('Full width button') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_submit">
                                    {{ __('Content width button') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_submit button_icon">
                                    <div class="button__icon-wrapper button__icon-wrapper_submit">
                                        @include('inline-svg/success', ['class' => 'button__submit-icon'])
                                    </div>
                                    {{ __('Content width button') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-sm-6">
                            <div class="form-group">
                                <div class="button button_submit button_size_small">
                                    {{ __('Small size') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-sm-12">
                            <div class="form-group">
                                <div class="button button_submit button_size_big button_full_width">
                                    {{ __('Big size') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-sm-12">
                            <div class="form-group">
                                <div class="button button_big_icon button_cancel button_size_big button_full_width">
                                    <div class="button__icon-wrapper button__icon-wrapper_cancel">
                                        @include('inline-svg/cancel', ['class' => 'button__cancel-icon'])
                                    </div>
                                    {{ __('Big size') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_submit button_size_large button_full_width">
                                    {{ __('Large size') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_large_icon button_cancel button_size_large button_full_width">
                                    <div class="button__icon-wrapper button__icon-wrapper_cancel">
                                        @include('inline-svg/cancel', ['class' => 'button__cancel-icon'])
                                    </div>
                                    {{ __('Large size') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group ui__form-group_buttons">

                                <div class="button button_info button_only_icon button_only_icon_extra-small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/view', ['class' => 'button__icon button__icon_extra-small button__view-icon'])
                                    </div>
                                </div>

                                <div class="button button_warning button_only_icon button_only_icon_extra-small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/edit', ['class' => 'button__icon button__icon_extra-small button__edit-icon'])
                                    </div>
                                </div>

                                <div class="button button_cancel button_only_icon button_only_icon_extra-small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__icon_extra-small button__close-icon'])
                                    </div>
                                </div>

                                <div class="button button_info button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/view', ['class' => 'button__icon button__icon_small button__view-icon'])
                                    </div>
                                </div>


                                <div class="button button_warning button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/edit', ['class' => 'button__icon button__icon_small button__edit-icon'])
                                    </div>
                                </div>

                                <div class="button button_cancel button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__icon_small button__close-icon'])
                                    </div>
                                </div>

                                <div class="button button_info button_only_icon">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/view', ['class' => 'button__icon button__view-icon'])
                                    </div>
                                </div>

                                <div class="button button_cancel button_only_icon">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__close-icon'])
                                    </div>
                                </div>


                                <div class="button button_warning button_only_icon button_only_icon_big">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/edit', ['class' => 'button__icon button__icon_big button__edit-icon'])
                                    </div>
                                </div>

                                <div class="button button_cancel button_only_icon button_only_icon_big">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__icon_big button__close-icon'])
                                    </div>
                                </div>

                                <div class="button button_info button_only_icon button_only_icon_large">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/cancel', ['class' => 'button__icon button__icon_large button__close-icon'])
                                    </div>
                                </div>

                                <button class="button button_info button_tooltip">
                                    ?
                                </button>

                                <button class="button button_submit button_tooltip button_tooltip_extra_small">
                                    ?
                                </button>

                                <div class="button button_cancel button_tooltip button_tooltip_big">
                                    ?
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>





        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Messages') }}</h2>

            <div class="card">

                <h3 class="title title_size_small title_indent_normal">Message Info</h3>

                <div class="message message_info ui__message">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                    non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                    veritatis vero voluptate!
                </div>

                <h3 class="title title_size_small title_indent_normal">Message Danger</h3>
                <div class="message message_danger ui__message">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                    non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                    veritatis vero voluptate!
                </div>

                <h3 class="title title_size_small title_indent_normal">Message Success</h3>
                <div class="message message_success ui__message">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                    non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                    veritatis vero voluptate!
                </div>

                <h3 class="title title_size_small title_indent_normal">Message Warning</h3>
                <div class="message message_warning ui__message">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                    non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                    veritatis vero voluptate!
                </div>

                <h3 class="title title_size_small title_indent_normal">Message Disabled</h3>
                <div class="message message_disabled ui__message">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                    non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                    veritatis vero voluptate!
                </div>

                <h3 class="title title_size_small title_indent_normal">Message Info with icon</h3>
                <div class="message message_icon message_info ui__message">
                    <div class="message__icon message__icon_info">
                        @include('inline-svg/info', ['class' => 'message__info-icon'])
                    </div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                    non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                    veritatis vero voluptate!
                </div>

                <h3 class="title title_size_small title_indent_normal">Message Danger with icon</h3>
                <div class="message message_icon message_danger ui__message">
                    <div class="message__icon message__icon_danger">
                        @include('inline-svg/danger', ['class' => 'message__danger-icon'])
                    </div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                    non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                    veritatis vero voluptate!
                </div>

                <h3 class="title title_size_small title_indent_normal">Message Success with icon</h3>
                <div class="message message_icon message_success ui__message">
                    <div class="message__icon message__icon_success">
                        @include('inline-svg/success', ['class' => 'message__success-icon'])
                    </div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                    non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                    veritatis vero voluptate!
                </div>

                <h3 class="title title_size_small title_indent_normal">Message Warning with icon</h3>
                <div class="message message_icon message_warning ui__message">
                    <div class="message__icon message__icon_warning">
                        @include('inline-svg/warning', ['class' => 'message__warning-icon'])
                    </div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                    non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                    veritatis vero voluptate!
                </div>



                <h3 class="title title_size_small title_indent_normal">Message with close</h3>
                <div class="message__wrapper" x-data="{ show_message: true }">
                    <div class="message message_info message_closed ui__message" x-show="show_message">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                        non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                        veritatis vero voluptate!
                        <div class="message__close" x-on:click="show_message = ! show_message">
                            @include('inline-svg/close', ['class' => 'message__close-icon'])
                        </div>
                    </div>
                </div>


            </div>

        </section>

    </div>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Popover') }}</h2>
            <div class="card">
                <div class="grid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="ui__item-wrapper">
                                <div class="popover popover_tail_none ui__popover">
                                    <div class="popover__inner">
                                        <div class="popover__title">
                                            {{ __('Popover title') }}
                                        </div>
                                        <div class="popover__content">
                                            Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="ui__item-wrapper">
                                <div class="popover ui__popover">
                                    <div class="popover__inner">
                                        <div class="popover__title">
                                            {{ __('Popover title') }}
                                        </div>
                                        <div class="popover__content">
                                            Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                        </div>
                                        <div class="popover__close">
                                            @include('inline-svg/close', ['class' => 'popover__close-icon'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="ui__item-wrapper">
                                <div class="popover popover_tail_left ui__popover">
                                    <div class="popover__inner">
                                        <div class="popover__title">
                                            {{ __('Popover title') }}
                                        </div>
                                        <div class="popover__content">
                                            Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                        </div>
                                        <div class="popover__close">
                                            @include('inline-svg/close', ['class' => 'popover__close-icon'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="ui__item-wrapper">
                                <div class="popover popover_tail_right ui__popover">
                                    <div class="popover__inner">
                                        <div class="popover__title">
                                            {{ __('Popover title') }}
                                        </div>
                                        <div class="popover__content">
                                            Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                        </div>
                                        <div class="popover__close">
                                            @include('inline-svg/close', ['class' => 'popover__close-icon'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="ui__item-wrapper">
                                <div class="popover ui__popover">
                                    <div class="popover__inner">
                                        <div class="popover__title">
                                            {{ __('Popover title') }}
                                        </div>
                                        <div class="popover__content">
                                            Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                        </div>
                                        <div class="popover__footer">
                                            <div class="popover__buttons">
                                                <button class="popover__button button button_size_small button_submit">Submit</button>
                                                <button class="popover__button button button_size_small button_cancel">Cancel</button>
                                            </div>
                                        </div>
                                        <div class="popover__button popover__close">
                                            @include('inline-svg/close', ['class' => 'popover__close-icon'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="ui__item-wrapper">
                                <div class="ui__popover-test" x-data="{ testPopoverHidden: true }">
                                    <div class="button button_submit" x-on:click.stop="testPopoverHidden = ! testPopoverHidden">Click me for popover</div>
                                    <div class="popover popover_tail_left popover_hidden ui__popover_visible" x-on:click.outside="testPopoverHidden = true" :class="testPopoverHidden ? '' : 'popover_visible'">
                                        <div class="popover__inner">
                                            <div class="popover__title">
                                                {{ __('Popover title') }}
                                            </div>
                                            <div class="popover__content">
                                                Lorem ipsum dolor sit amet, sxcv sdf consectetur adipisicing elit
                                            </div>
                                            <div class="popover__button popover__close" x-on:click="testPopoverHidden = true">
                                                @include('inline-svg/close', ['class' => 'popover__close-icon'])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="ui__item-wrapper">

                                <button class="button button_info button_tooltip tooltip_trigger" data-tooltip="tooltip_1">?</button>
                                <div id="tooltip" role="tooltip" class="tooltip tooltip_1" style="display: none">
                                    Tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip
                                    <div id="arrow" class="tooltip__arrow"></div>
                                </div>

                                <button class="button button_cancel button_tooltip button_tooltip_big tooltip_trigger" data-tooltip="tooltip_2">?</button>
                                <div id="tooltip" role="tooltip" class="tooltip tooltip_2" style="display: none">
                                    Big tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip
                                    <div id="arrow" class="tooltip__arrow"></div>
                                </div>

                                <button class="button button_submit button_tooltip button_tooltip_extra_small tooltip_trigger" data-tooltip="tooltip_3">?</button>
                                <div id="tooltip" role="tooltip" class="tooltip tooltip_3" style="display: none">
                                    Small tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip tooltip
                                    <div id="arrow" class="tooltip__arrow"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Tabs') }}</h2>
            <div class="card">
                <div class="grid grid_c">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="tabs">
                                <ul class="tabs__header">
                                    <li class="tabs__header-link">First</li>
                                    <li class="tabs__header-link">Second</li>
                                    <li class="tabs__header-link">Third</li>
                                </ul>
                                <ul class="tabs__content">
                                    <li class="tabs__content-block post">
                                        <h2 class="title title_indent_normal title_size_normal">First tab content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias aperiam assumenda aut deserunt doloremque, fugit iusto libero, nostrum porro possimus quisquam? Iure, nisi!</p>
                                    </li>
                                    <li class="tabs__content-block">
                                        <h2 class="title title_indent_normal title_size_normal">Second tab content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias.</p>
                                    </li>
                                    <li class="tabs__content-block">
                                        <h2 class="title title_indent_normal title_size_normal">Third tab content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias aperiam assumenda aut deserunt doloremque, fugit iusto libero, nostrum porro possimus quisquam? Iure, nisi!</p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="tabs">
                                <ul class="tabs__header">
                                    <li class="tabs__header-link tabs__header-link_button button button_dark">First</li>
                                    <li class="tabs__header-link tabs__header-link_button button button_dark tabs__header-link_active">Second</li>
                                    <li class="tabs__header-link tabs__header-link_button button button_dark">Third</li>
                                </ul>
                                <ul class="tabs__content">
                                    <li class="tabs__content-block">
                                        <h2 class="title title_indent_normal title_size_normal">First button tab content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias aperiam assumenda aut deserunt doloremque, fugit iusto libero, nostrum porro possimus quisquam? Iure, nisi!</p>
                                    </li>
                                    <li class="tabs__content-block tabs__content-block_active">
                                        <h2 class="title title_indent_normal title_size_normal">Buttons second tab</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias.</p>
                                    </li>
                                    <li class="tabs__content-block">
                                        <h2 class="title title_indent_normal title_size_normal">Third button tab content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus inventore itaque nemo veniam veritatis! Accusantium alias aperiam assumenda aut deserunt doloremque, fugit iusto libero, nostrum porro possimus quisquam? Iure, nisi!</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Badges') }}</h2>
            <div class="card">
                <div class="grid grid_c">
                    <div class="row">
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_submit ui__button_badge">
                                    Badge round
                                    <div class="badge badge_standard_size_small ui__badge_standard"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_submit ui__button_badge">
                                    Badge round
                                    <div class="badge badge_standard ui__badge_standard"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_submit ui__button_badge">
                                    Badge round
                                    <div class="badge badge_standard_size_big ui__badge_standard"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_dark ui__button_badge">
                                    Badge round
                                    <div class="badge badge_standard badge_success ui__badge_standard"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_dark ui__button_badge">
                                    Badge round
                                    <div class="badge badge_number badge_success ui__badge_standard">12</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="button button_dark ui__button_badge">
                                    Badge round
                                    <div class="badge badge_number ui__badge_standard">5</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
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
                                    <div class="badge badge_ribbon badge_ribbon_left">Ribbon badge</div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="image image_standard ui__badge_placeholder">
                                    <div class="badge badge_bookmark"><span class="badge__bookmark-wrapper">new</span></div>
                                    <div class="badge badge_ribbon badge_success badge_ribbon_right badge_ribbon_right_danger">Ribbon badge</div>
                                    <div class="badge badge_ribbon badge_info badge_ribbon_right badge_ribbon_right_danger ui__ribbon_test_1">Ribbon badge</div>
                                    <div class="badge badge_ribbon badge_warning badge_ribbon_right badge_ribbon_right_danger ui__ribbon_test_2">Ribbon badge</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="image image_standard ui__badge_placeholder">
                                    <div class="badge badge_bookmark">@include('inline-svg/star', ['class' => 'badge__star'])</div>
                                    <div class="badge badge_success badge_bookmark badge_bookmark_right">new</div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Tabulator') }}</h2>
            <div class="card">
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
                                        @include('inline-svg/view', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/edit', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__icon_small'])
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
                                        @include('inline-svg/view', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/edit', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__icon_small'])
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
                                        @include('inline-svg/view', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/edit', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__icon_small'])
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
                                        @include('inline-svg/view', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/edit', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__icon_small'])
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
                                        @include('inline-svg/view', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/edit', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__icon_small'])
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
                                        @include('inline-svg/view', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_warning button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/edit', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>

                                <div class="button button_icon button_cancel button_only_icon button_only_icon_small">
                                    <div class="button__icon-wrapper">
                                        @include('inline-svg/close', ['class' => 'button__icon button__icon_small'])
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Modal') }}</h2>
            <div class="card">
                <div class="grid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                                <div class="form-group">
                                    <button x-on:click.stop="modalHide = ! modalHide" class="button button_submit button_full_width">Open Extra Small Modal</button>
                                </div>
                                <section  class="modal" :class="modalHide ? '' : 'modal_show'">
                                    <div  x-on:click.outside="modalHide = true" class="modal__content modal__content_size_extra_small">

                                        <div x-on:click="modalHide = true" class="modal__close">
                                            @include('inline-svg/close', ['class' => 'modal__close-icon'])
                                        </div>

                                        <div class="modal__header">
                                            <div class="title title_size_big title_indent_normal">Header</div>
                                        </div>
                                        <div class="modal__body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                                        </div>
                                        <div class="modal__footer modal__footer_buttons">
                                            <div class="button button_submit button_only_icon button_only_icon button_indent_right">
                                                <div class="button__icon-wrapper">
                                                    @include('inline-svg/success', ['class' => 'button__icon button__icon_big button__edit-icon'])
                                                </div>
                                            </div>

                                            <div x-on:click="modalHide = true" class="button button_cancel button_only_icon button_only_icon">
                                                <div class="button__icon-wrapper">
                                                    @include('inline-svg/cancel', ['class' => 'button__icon button__icon_big button__close-icon'])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                                <div class="form-group">
                                    <button x-on:click.stop="modalHide = ! modalHide" class="button button_info button_full_width">Open Small Modal</button>
                                </div>
                                <section  class="modal" :class="modalHide ? '' : 'modal_show'">
                                    <div  x-on:click.outside="modalHide = true" class="modal__content modal__content_size_small">

                                        <div x-on:click="modalHide = true" class="modal__close">
                                            @include('inline-svg/close', ['class' => 'modal__close-icon'])
                                        </div>

                                        <div class="modal__header">
                                            <div class="title title_indent_normal">Header</div>
                                        </div>
                                        <div class="modal__body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                                        </div>
                                        <div class="modal__footer modal__footer_buttons">
                                            <div class="button button_submit button button_indent_right">Submit</div>
                                            <div x-on:click="modalHide = true" class="button button_cancel">Cancel</div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                                <div class="form-group">
                                    <button x-on:click.stop="modalHide = ! modalHide" class="button button_warning button_full_width">Open Normal Modal</button>
                                </div>
                                <section  class="modal" :class="modalHide ? '' : 'modal_show'">
                                    <div  x-on:click.outside="modalHide = true" class="modal__content modal__content_size_normal">

                                        <div x-on:click="modalHide = true" class="modal__close">
                                            @include('inline-svg/close', ['class' => 'modal__close-icon'])
                                        </div>

                                        <div class="modal__header">
                                            <div class="title title_indent_normal">Header</div>
                                        </div>
                                        <div class="modal__body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                                        </div>
                                        <div class="modal__footer modal__footer_buttons">
                                            <div class="button button_submit button button_indent_right">Submit</div>
                                            <div x-on:click="modalHide = true" class="button button_cancel">Cancel</div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                                <div class="form-group">
                                    <button x-on:click.stop="modalHide = ! modalHide" class="button button_submit button_full_width">Open Big Modal</button>
                                </div>
                                <section  class="modal" :class="modalHide ? '' : 'modal_show'">
                                    <div  x-on:click.outside="modalHide = true" class="modal__content modal__content_size_big">

                                        <div x-on:click="modalHide = true" class="modal__close">
                                            @include('inline-svg/close', ['class' => 'modal__close-icon'])
                                        </div>

                                        <div class="modal__header">
                                            <div class="title title_indent_normal">Header</div>
                                        </div>
                                        <div class="modal__body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                                        </div>
                                        <div class="modal__footer modal__footer_buttons">
                                            <div class="button button_submit button button_indent_right">Submit</div>
                                            <div x-on:click="modalHide = true" class="button button_cancel">Cancel</div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div x-data="{modalHide: true}" x-on:keydown.escape.window="modalHide = true">
                                <div class="form-group">
                                    <button x-on:click.stop="modalHide = ! modalHide" class="button button_cancel button_full_width">Open Large Modal</button>
                                </div>
                                <section  class="modal" :class="modalHide ? '' : 'modal_show'">
                                    <div  x-on:click.outside="modalHide = true" class="modal__content modal__content_size_large">

                                        <div x-on:click="modalHide = true" class="modal__close">
                                            @include('inline-svg/close', ['class' => 'modal__close-icon'])
                                        </div>

                                        <div class="modal__header">
                                            <div class="title title_indent_normal">Header</div>
                                        </div>
                                        <div class="modal__body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi aperiam architecto commodi, cum earum fugit hic ipsum maxime neque quasi quia recusandae reiciendis rem. Facilis nemo quia sunt!
                                        </div>
                                        <div class="modal__footer modal__footer_buttons">
                                            <div class="button button_submit button button_indent_right">Submit</div>
                                            <div x-on:click="modalHide = true" class="button button_cancel">Cancel</div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div x-data="{toastHide: true}">
                                <div class="form-group">
                                    <button x-on:click.stop="toastHide = ! toastHide; setTimeout(() => toastHide = true, 3000)" class="button button_info button_full_width">Show Toast</button>
                                </div>
                                <div  class="toast" :class="toastHide ? '' : 'toast_show'" >
                                    <div class="message message_info message_closed ui__message">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam doloremque nemo
                                        non possimus quae quas quasi. Ab atque commodi dicta eos, nam nulla numquam obcaecati quis, rem
                                        veritatis vero voluptate!
                                        <div class="message__close" x-on:click="toastHide = true">
                                            @include('inline-svg/close', ['class' => 'message__close-icon'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Accordion') }}</h2>
            <div class="card">
                <div class="accordion accordion_light">
                    <details class="accordion__item">
                        <summary  class="accordion__title">Lorem ipsum dolor sit amet?</summary>
                        <div class="accordion__text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                        </div>
                    </details>

                    <details class="accordion__item accordion__item_light">
                        <summary  class="accordion__title">Aut delectus error eum iste suscipit?</summary>
                        <div class="accordion__text">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                            </p>
                        </div>
                    </details>

                    <details class="accordion__item">
                        <summary  class="accordion__title">Lorem ipsum dolor sit amet, consectetur adipisicing elit?</summary>
                        <div class="accordion__text">
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
                        </div>
                    </details>

                    <details class="accordion__item">
                        <summary  class="accordion__title">Amet cupiditate dignissimos hic ipsa?</summary>
                        <div class="accordion__text">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                            </p>
                        </div>
                    </details>

                    <details class="accordion__item" open>
                        <summary  class="accordion__title"><span class="accordion__question">Cupiditate dignissimos hic ipsa?</span></summary>
                        <div class="accordion__text">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut delectus error eum iste suscipit! Amet cupiditate dignissimos hic ipsa iusto natus perspiciatis quisquam reprehenderit vitae? Accusantium earum nobis quaerat quod!
                            </p>                        </div>
                    </details>
                </div>
            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Swiper') }}</h2>
            <div class="card">

                <div class="swiper ui__swiper">
                    <div class="swiper__carousel">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test.jpg') }}"
                                    srcset="
                                    {{ asset('/storage/test-300.jpg') }} 300w,
                                    {{ asset('/storage/test-650.jpg') }} 650w,
                                    {{ asset('/storage/test-800.jpg') }} 800w,
                                    {{ asset('/storage/test-1200.jpg') }} 1200w,
                                    {{ asset('/storage/test.jpg') }} 1500w,
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
                            </div>
                            <div class="swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test-2.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test-3.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test-4.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test-5.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                        </div>

                        <div class="swiper-pagination swiper-pagination_1"></div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                    </div>

                </div>

                <div class="swiper">
                    <div class="swiper__full">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide ui__test-swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test.jpg') }}"
                                    srcset="
                                    {{ asset('/storage/test-300.jpg') }} 300w,
                                    {{ asset('/storage/test-650.jpg') }} 650w,
                                    {{ asset('/storage/test-800.jpg') }} 800w,
                                    {{ asset('/storage/test-1200.jpg') }} 1200w,
                                    {{ asset('/storage/test.jpg') }} 1500w,
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
                            </div>
                            <div class="swiper-slide ui__test-swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test-2.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="swiper-slide ui__test-swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test-3.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="swiper-slide ui__test-swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test-4.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="swiper-slide ui__test-swiper-slide">
                                <img
                                    class="swiper__img"
                                    src="{{ asset('/storage/test-5.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                        </div>

                        <div class="swiper-pagination swiper-pagination_2"></div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>

            </div>
        </section>

        <section class="ui__section">
            <h2 class="title title_big title_indent_big">{{ __('Filepond') }}</h2>
            <div class="card">
                <div class="grid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <input class="filepond1"
                                    type="file"
                                    name="filepond"
                                    accept="image/png, image/jpeg, image/gif"
                                    multiple />
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <input type="file"
                                   class="filepond2"
                                   name="filepond"
                                   multiple
                                   data-allow-reorder="true"
                                   data-max-file-size="3MB"
                                   data-max-files="3">
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                            <input type="file"
                                   class="filepond3"
                                   name="filepond"
                                   accept="image/png, image/jpeg, image/gif"
                                   data-allow-reorder="true"
                                   data-max-file-size="3MB">
                        </div>
                    </div>
                </div>
            </div>
        </section>



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
            footerElement:"<button class='button button_submit'>Custom Button</button>",
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
            slidesPerView: 3,

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
