<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ $title }} - Admin Panel</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ secure_asset('admin/img/ch-logo.png') }}" type="image/png">

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="{{ asset('admin/css/admin-style.css') }}" rel="stylesheet">
    
    <!-- Preload Critical Assets -->
    <link rel="preload" href="{{ secure_asset('admin/css/adminstyle.css') }}" as="style">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('admin/css/adminstyle.css') }}">
    
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

        .admin-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            height: var(--header-height);
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .header-content {
            padding: 0 25px;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
        }

        .logo {
            height: 50px;
            margin-right: 20px;
        }

        .logo-link h2 {
            font-size: 24px;
            margin: 0;
        }

        .admin-body {
            display: flex;
            flex: 1;
            margin-top: var(--header-height);
        }

        .admin-nav {
            width: var(--nav-width);
            background: #f8f9fa;
            padding: 25px;
            position: fixed;
            left: 0;
            top: var(--header-height);
            bottom: 0;
            overflow-y: auto;
        }

        .admin-main {
            flex: 1;
            margin-left: var(--nav-width);
            padding: 25px;
            background: #fff;
        }

        /* Content styles */
        .content-wrapper {
            min-height: calc(100vh - var(--header-height));
            padding: 25px;
        }

        .form {
            width: 100%;
            margin-bottom: 25px;
            font-size: 1.2rem;
        }

        .form th {
            padding: 20px;
            text-align: left;
            vertical-align: top;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .form td {
            padding: 20px;
            vertical-align: top;
            font-size: 1.2rem;
        }

        .badge {
            font-size: 1.3rem;
            padding: 15px 20px;
            margin: 0 8px;
            border-radius: 8px;
            display: inline-block;
        }

        table {
            margin-bottom: 2rem;
            width: 100%;
            font-size: 1.2rem;
        }

        .card {
            margin-bottom: 2rem;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Mobile responsive styles */
        @media (max-width: 768px) {
            body {
                font-size: 20px;
                -webkit-text-size-adjust: 100%;
            }

            .admin-header {
                height: var(--header-height);
            }

            .header-content {
                padding: 0 20px;
            }

            .logo {
                height: 60px;
            }

            .logo-link h2 {
                font-size: 28px;
            }

            .admin-nav {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                padding: 30px;
            }

            .admin-nav.active {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
                padding: 20px;
            }

            .content-wrapper {
                padding: 20px;
            }

            .form th, .form td {
                padding: 20px;
                font-size: 1.4rem;
            }

            .badge {
                font-size: 1.5rem;
                padding: 20px 25px;
                margin: 8px;
                display: block;
                text-align: center;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                font-size: 1.4rem;
            }

            .card {
                margin: 15px 0;
                padding: 25px;
            }

            h1 { font-size: 2.2rem; }
            h2 { font-size: 1.8rem; }
            h3 { font-size: 1.6rem; }
            h4 { font-size: 1.4rem; }
            h5 { font-size: 1.3rem; }
            h6 { font-size: 1.2rem; }

            .btn {
                padding: 15px 25px;
                font-size: 1.3rem;
                width: 100%;
                margin: 10px 0;
            }

            .nav-link {
                font-size: 1.4rem;
                padding: 15px 0;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background: #1a1a1a;
                color: #fff;
            }

            .admin-header {
                background: #2d2d2d;
            }

            .admin-nav {
                background: #2d2d2d;
            }

            .admin-main {
                background: #1a1a1a;
            }

            .card {
                background: #2d2d2d;
            }

            .form th, .form td {
                border-color: #404040;
            }
        }
    </style>
    
    <!-- Defer Non-Critical Scripts -->
    <script defer>
        // Register Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('{{ secure_asset('admin/sw.js') }}')
                    .then(registration => {
                        console.log('ServiceWorker registration successful');
                    })
                    .catch(err => {
                        console.log('ServiceWorker registration failed: ', err);
                    });
            });
        }

        function deleteRecord() {
            if (!confirm("Are you sure you want to delete this record?")) return false;
            this.click();
        }

        function confirmAction(message) {
            if (!confirm(message)) return false;
            this.click();
        }

        function logoutUser() {
            if (!confirm("Are you sure you want to logout?")) return false;
            this.click();
        }

        function closeAlert() {
            document.querySelector('.alert').style.display = 'none';
        }
    </script>
</head>

<body>
    <div class="admin-container">
        <header class="admin-header">
            <div class="header-content">
                <a href="{{ route('admin.dashboard') }}" class="logo-link">
                    <img src="{{ secure_asset('admin/img/ch-logo.png') }}" alt="Logo" class="logo">
                    <h2>Admin Dashboard</h2>
                </a>
            </div>
        </header>

        <div class="admin-body">
            <nav class="admin-nav">
                <x-navigation.admin :slug="$slug"/>
            </nav>
            
            <main class="admin-main">
                <x-flash-bag.admin />
                {{ $slot }}
            </main>
        </div>

        <footer class="admin-footer">
            <div class="footer-content">
                Powered by <a href="https://github.com/onumahkalusamuel/gobitrage/" target="_blank" rel="noopener">Gobitrage</a>. All Rights Reserved.
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
    <!-- View Mode Script -->
    <script src="{{ asset('assets/js/view-mode.js') }}"></script>
</body>

</html>
