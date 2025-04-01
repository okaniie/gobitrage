<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
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
        /* Base styles */
        :root {
            --header-height: 70px;
            --nav-width: 280px;
        }

        body {
            font-size: 18px;
            line-height: 1.6;
            -webkit-text-size-adjust: 100%;
            touch-action: pan-x pan-y;
            -webkit-touch-callout: default;
            -webkit-user-select: text;
            user-select: text;
        }

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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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

    <!-- Begin of Chaport Live Chat code -->
    <script type="text/javascript">
    (function(w,d,v3){
    w.chaportConfig = {
      appId : '67eb37fb4492a3ec53055f19'
    };

    if(w.chaport)return;v3=w.chaport={};v3._q=[];v3._l={};v3.q=function(){v3._q.push(arguments)};v3.on=function(e,fn){if(!v3._l[e])v3._l[e]=[];v3._l[e].push(fn)};var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://app.chaport.com/javascripts/insert.js';var ss=d.getElementsByTagName('script')[0];ss.parentNode.insertBefore(s,ss)})(window, document);
    </script>
    <!-- End of Chaport Live Chat code -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update CSRF token for all forms
        function updateCsrfToken() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            document.querySelectorAll('input[name="_token"]').forEach(input => {
                input.value = token;
            });
        }

        // Handle logout
        document.querySelector('.btn-logout').addEventListener('click', function(e) {
            e.preventDefault();
            updateCsrfToken();
            document.getElementById('logout-form').submit();
        });
    });
    </script>
</body>

</html>
