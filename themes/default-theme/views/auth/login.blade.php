<x-template.guest>
    <style>
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        /* Enhanced placeholder styles */
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
            opacity: 1;
            font-weight: 500;
        }

        .form-control:focus::placeholder {
            color: rgba(255, 255, 255, 0.9);
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .form-floating > label {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            color: #fff;
        }
    </style>
    <div class="form-signin my-5">
        <form class="mt-5 mb-2" method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">{{ __('Login') }}</h1>

            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">{{ __('E-Mail Address') }}</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    required autocomplete="current-password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="checkbox mb-3">
                <label>
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Login') }}</button>
        </form>
        @if (Route::has('register'))
            <a class="btn btn-link" href="{{ route('register') }}">
                {{ __('Register New Account') }}
            </a>
        @endif
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </div>


</x-template.guest>
