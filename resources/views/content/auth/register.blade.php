@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="auth__content">
            <div class="card auth__card">
                <div class="card__header">
                    <div class="card__title">
                        {{ __('Register') }}
                    </div>
                </div>

                <div class="card__body">
                    <form class="form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <div class="input-text">
                                <input class="input-text__field @error('name') input-text__error @enderror"
                                       id="name" type="text" name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="input-text__label" for="name">{{ __('Name') }}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-text">
                                <input class="input-text__field @error('email') input-text__error @enderror"
                                       id="email" type="email" name="email"
                                       value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="input-text__label" for="email">{{ __('E-Mail Address') }}</label>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-text">
                                <input class="input-text__field @error('password') input-text__error @enderror"
                                       id="password" type="password" name="password"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="input-text__label" for="password">{{ __('Password') }}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-text">
                                <input class="input-text__field" id="password-confirm" type="password"
                                       name="password_confirmation" required autocomplete="new-password">
                                <label class="input-text__label"
                                       for="password-confirm">{{ __('Confirm Password') }}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="button button_submit button_full_width">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
