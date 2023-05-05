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
                                    <div class="button__icon button__icon_submit">
                                        @include('inline-svg/success', ['class' => 'button__submit-icon'])
                                    </div>
                                    {{ __('With icon') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="button button_cancel button_icon button_full_width">
                                    <div class="button__icon button__icon_cancel">
                                        @include('inline-svg/cancel', ['class' => 'button__cancel-icon'])
                                    </div>
                                    {{ __('With icon') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="button button_dark button_icon button_full_width">
                                    <div class="button__icon button__icon_cancel">
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
                                    <div class="button__icon button__icon_submit">
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
                                    <div class="button__icon button__icon_cancel">
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
                                    <div class="button__icon button__icon_cancel">
                                        @include('inline-svg/success', ['class' => 'button__cancel-icon'])
                                    </div>
                                    {{ __('Large size') }}
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

        const editor = new EditorJS({
            /**
             * Id of Element that should contain Editor instance
             */
            holder: 'editorjs',
        })
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

    </script>
@endpush
