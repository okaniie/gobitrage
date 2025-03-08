<style>
    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .text-small {
        font-size: 85%;
    }
</style>
<header>
    <div class="px-3 py-2 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="{{ url('/') }}"
                    class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                    @if (\App\Models\Setting::get('use_logo'))
                        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                            <use xlink:href="#bootstrap" />
                        </svg>
                    @else
                        {{ config('app.name', 'Crypto HYIP Pro') }}
                    @endif
                </a>

                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li>
                        <a href="{{ url('/') }}" class="nav-link text-secondary">
                            <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                                <use xlink:href="#home" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/about-us') }}" class="nav-link text-white">
                            <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                                <use xlink:href="#table" />
                            </svg>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/faqs') }}" class="nav-link text-white">
                            <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                                <use xlink:href="#grid" />
                            </svg>
                            FAQs
                        </a>
                    </li>
                    @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}" class="nav-link text-white">
                                <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                                    <use xlink:href="#people-circle" />
                                </svg>
                                Account
                            </a>
                        </li>
                    @endif
                    {{-- <li>
                        <div style="display:table-cell; vertical-align:middle" class="nav-link"
                            id="google_translate_element"></div>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</header>
