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
    </style>
    <div class="form-signin my-5">
        <form class="mt-5 mb-2" method="POST" action="{{ route('register') }}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">{{ __('Register') }}</h1>

            <div class="form-floating">
                <input class="form-control @error('username') is-invalid @enderror" name="username"
                    value="{{ old('username') }}" autocomplete="username" id="username" placeholder="john.doe">
                <label for="username">{{ __('Username (optional)') }}</label>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-floating">
                <input class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" id="name" placeholder="John Doe">
                <label for="name">{{ __('Full Name') }}</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" id="email" placeholder="john@doe.com">
                <label for="email">{{ __('E-Mail Address') }}</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-floating">
                <input type="text" class="form-control @error('password') is-invalid @enderror" name="password"
                    required autocomplete="current-password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Register') }}</button>
        </form>
        @if (Route::has('login'))
            <a class="btn btn-link" href="{{ route('login') }}">
                {{ __('Login To Account') }}
            </a>
        @endif
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </div>

</x-template.guest>
