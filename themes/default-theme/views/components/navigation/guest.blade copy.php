<style>
    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .text-small {
        font-size: 85%;
    }
</style>

{{-- <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Gobitrage
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/about-us') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/investment-plans') }}">Investment Plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/faqs') }}">FAQs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/contact-us') }}">Contact Us</a>
                </li>
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary ms-2" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light ms-2" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav> --}}


<nav class="bg-black p-4 border-b border-gray-200 shadow-md" >
    <div class=" flex flex items-center justify-between px-4 py-2">
        <div class="flex items-center justify-between w-full md:w-auto">
            <a class="navbar-brand" href="{{ url('/') }}">
                Gobitrage
            </a>
        </div>

        <div class="flex md:items-center md:gap-10 gap-15 lg:text-lg text-sm text-gray-800 w-full md:w-auto mt-4 ml-10 md:mt-0" >
            <ul class="flex gap-10 md:gap-10 items-start md:items-center ">
                <li>
                    <a class="nav-link hover:text-blue-600" href="{{ url('/home') }}">Home</a>
                </li>
                <li>
                    <a class="nav-link hover:text-blue-600" href="{{ url('/about-us') }}">About Us</a>
                </li>
                <li>
                    <a class="nav-link hover:text-blue-600" href="{{ url('/investment-plans') }}">Investment Plans</a>
                </li>
                <li>
                    <a class="nav-link hover:text-blue-600" href="{{ url('/faqs') }}">FAQs</a>
                </li>
                <li>
                    <a class="nav-link hover:text-blue-600" href="{{ url('/contact-us') }}">Contact Us</a>
                </li>
            </ul>

            <ul class="flex flex-col md:flex-row gap-4 md:gap-5 mt-4 md:mt-0 md:ml-auto">
                @if (Route::has('login'))
                <li>
                    <a  class="nav-link btn btn-primary ms-2" href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Login
                    </a>
                </li>
                @if (Route::has('register'))
                <li>
                    <a class="nav-link btn btn-outline-light ms-2" href="{{ route('register') }}">Register</a>
                </li>
                @endif
                @endif
            </ul>
        </div>
    </div>
</nav>