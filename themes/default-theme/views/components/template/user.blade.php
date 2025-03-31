<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1, maximum-scale=0.1, user-scalable=no">
    {{-- <meta name="description" content=""> --}}
    {{-- <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - {{ config('app.name', 'Crypto-HYIP') }}</title>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('themes/default-theme/css/user-style.css') }}" rel="stylesheet">

    <style>
        .navbar {
            background: #13151c;
            border-bottom: 1px solid #1c1f2a;
            padding: 1rem;
        }

        .navbar-brand {
            color: #fff;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .navbar-toggler {
            border: none;
            color: #fff;
            padding: 0;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .offcanvas {
            background: #13151c;
        }

        .offcanvas-header {
            border-bottom: 1px solid #1c1f2a;
        }

        .offcanvas-title {
            color: #fff;
        }

        .nav-link {
            color: #5d6588;
            padding: 1rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff;
            background: #1c1f2a;
        }

        .nav-link i {
            width: 24px;
            margin-right: 10px;
            text-align: center;
        }

        .user-header {
            background: #13151c;
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #1c1f2a;
        }

        .user-header h1 {
            color: #fff;
            font-size: 1.5rem;
            margin: 0;
        }

        .user-header p {
            color: #5d6588;
            margin: 0;
        }

        .btn-logout {
            color: #dc3545;
            background: transparent;
            border: 1px solid #dc3545;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            color: #fff;
            background: #dc3545;
        }

        @media (max-width: 768px) {
            .offcanvas {
                width: 280px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainMenu">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                Gobitrage
            </a>
            <div class="d-flex align-items-center">
                <a href="{{ route('user.profile') }}" class="text-light me-3">
                    <i class="fas fa-user-circle fa-lg"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start" id="mainMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column h-100">
                <div class="nav flex-column">
                    <a href="{{ route('user.dashboard') }}" class="nav-link {{ $slug == 'dashboard' ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                    <a href="{{ route('user.deposits') }}" class="nav-link {{ $slug == 'deposits' ? 'active' : '' }}">
                        <i class="fas fa-wallet"></i> Deposits
                    </a>
                    <a href="{{ route('user.withdrawals') }}" class="nav-link {{ $slug == 'withdrawals' ? 'active' : '' }}">
                        <i class="fas fa-money-bill-wave"></i> Withdrawals
                    </a>
                    <a href="{{ route('user.referrals') }}" class="nav-link {{ $slug == 'referrals' ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Referrals
                    </a>
                    <a href="{{ route('user.transactions') }}" class="nav-link {{ $slug == 'transactions' ? 'active' : '' }}">
                        <i class="fas fa-history"></i> Transactions
                    </a>
                    <a href="{{ route('user.profile') }}" class="nav-link {{ $slug == 'profile' ? 'active' : '' }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </div>
                <div class="mt-auto">
                    <hr class="border-secondary">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                        class="btn btn-logout w-100">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- User Header -->
    <div class="user-header" style="margin-top: 72px;">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>{{ $title }}</h1>
                    <p>Welcome back, {{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="main-body w-100" style="min-height: calc(100vh - 180px); background: #0a0b0e;">
            {{ $slot }}
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
    <!-- View Mode Script -->
    <script src="{{ asset('assets/js/view-mode.js') }}"></script>

    <script>
        // Close offcanvas when clicking on a nav link on mobile
        if (window.innerWidth < 992) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    const offcanvas = document.querySelector('#mainMenu');
                    const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
                    bsOffcanvas.hide();
                });
            });
        }
    </script>

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '0c5f48735f0e2df778ee1ab793f855009f75ccce';
        window.smartsupp||(function(d) {
            var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
            s=d.getElementsByTagName('script')[0];c=d.createElement('script');
            c.type='text/javascript';c.charset='utf-8';c.async=true;
            c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
    </script>
    <noscript> Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>
</body>

</html>
