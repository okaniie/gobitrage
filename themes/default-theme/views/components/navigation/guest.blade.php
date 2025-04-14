<style>
    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }
</style>


<nav class="bg-[#1a1a1a] p-4 border-b shadow-md text-nowrap" >
    <div class=" flex items-center justify-between lg:gap-[320px] px-4 py-2">
        <div class="w-full md:w-auto flex">
            <a class="navbar-brand" href="{{ url('/') }}">
                Gobitrage
            </a>
        </div>

        <div class="flex items-center lg:pl-15 text-md text-gray-800 w-full" >
            <ul class="flex gap-3 items-center ">
                <li>
                    <a class="nav-link hover:text-blue-600 p-2" href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a class="nav-link hover:text-blue-600 p-2" href="{{ url('/about-us') }}">About Us</a>
                </li>
                <li>
                    <a class="nav-link hover:text-blue-600 p-2" href="{{ url('/investment-plans') }}">Investment Plans</a>
                </li>
                <li>
                    <a class="nav-link hover:text-blue-600 p-2" href="{{ url('/faqs') }}">FAQs</a>
                </li>
                <li>
                    <a class="nav-link hover:text-blue-600 p-2" href="{{ url('/contact-us') }}">Contact Us</a>
                </li>
            </ul>

            <ul class="flex gap-1">
                @if (Route::has('login'))
                <li>
                    <a  class="nav-link btn-primary p-2 ml-2 border rounded-sm" href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Login
                    </a>
                </li>
                @if (Route::has('register'))
                <li>
                    <a class="nav-link p-2 ml-2 border rounded-sm hover:bg-white " href="{{ route('register') }}">Register</a>
                </li>
                @endif
                @endif
            </ul>
        </div>
    </div>
</nav>