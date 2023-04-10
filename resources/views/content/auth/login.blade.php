@extends('layouts.auth')

@section('title', 'Авторизация')

@section('content')
    <div class="container">
        <div class="auth__content">
            <div class="card auth__card">
                <div class="card__header">
                    <div class="card__title">
                        {{ __('Login') }}
                    </div>
                </div>

                <div class="card__body">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <div class="input-text">
                                <input class="input-text__field @error('email') input-text__error @enderror"
                                       id="email" type="email" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                       required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="input-text__label" for="password">{{ __('Password') }}</label>
                            </div>
                        </div>

                        <div class="form-group form-group_small">
                            <div class="input-checkbox">
                                <input class="input-checkbox__field" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="input-checkbox__label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button type="submit" class="button button_submit button_full_width">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <div class="auth__forgot">
                                    <a class="auth__forgot-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
