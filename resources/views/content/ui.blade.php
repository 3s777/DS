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
            <h2 class="title title_big title_indent_big">{{ __('Forms') }}</h2>

            <div class="card">
                <h3 class="title title_size_small">Text input</h3>
                <div class="form-group">
                    <div class="input-text">
                        <input class="input-text__field"
                               id="text" type="text" name="text"
                               value="{{ old('text') }}" required autocomplete="text">
                        <label class="input-text__label" for="text">{{ __('Text') }}</label>
                    </div>
                </div>

                <h3 class="title title_size_small">Text input with error</h3>
                <div class="form-group">
                    <div class="input-text">
                        <input class="input-text__field  input-text__field_error"
                               id="text" type="text" name="text"
                               value="{{ old('text') }}" required autocomplete="text">
                        <label class="input-text__label" for="text">{{ __('Text') }}</label>
                    </div>
                </div>

                <h3 class="title title_size_small">Switchers</h3>
                <div class="form-group">
                    <div class="input-checkbox">
                        <input class="input-checkbox__field" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="input-checkbox__label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <h3 class="title title_size_small">Buttons</h3>
                <div class="form-group">
                    <button type="submit" class="button button_submit button_full_width">
                        {{ __('Login') }}
                    </button>
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





    </div>
@endsection
