@extends('layouts.auth')

@section('title', __('Authorization'))

@section('content')
    <div class="container">
        <div class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1" class="card__title">
                        {{ __('Login') }}
                    </x-ui.title>
                </x-slot>


                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <div class="input-text">


                                <x-ui.form.input-text
                                    :errors="$errors"
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    placeholder="{{ __('Email') }}"
                                    required
                                    autofocus
                                    autocomplete="email">
                                </x-ui.form.input-text>



                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror


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

            </x-ui.card>
        </div>
    </div>
@endsection
