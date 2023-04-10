@extends('layouts.auth')

@section('content')
    <div class="container">

        <div class="auth__content">
            <div class="card auth__card">
                <div class="card__header">
                    <div class="card__title">
                        {{ __('Reset Password') }}
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <div class="input-text">
                                <input class="input-text__field @error('email') is-invalid @enderror"
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
                            <button type="submit" class="button button_submit button_full_width">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
