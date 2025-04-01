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
            --zoom-level: 1;
            --primary-color: #ff8d00;
            --secondary-color: #333;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: var(--secondary-color);
            background-color: var(--light-color);
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
            background: var(--primary-color);
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
            justify-content: space-between;
        }

        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #fff;
        }

        .logo {
            height: 40px;
            margin-right: 15px;
        }

        .logo-link h2 {
            font-size: 20px;
            margin: 0;
            font-weight: 600;
        }

        .admin-body {
            display: flex;
            flex: 1;
            margin-top: var(--header-height);
        }

        .admin-nav {
            width: var(--nav-width);
            background: #fff;
            padding: 25px;
            position: fixed;
            left: 0;
            top: var(--header-height);
            bottom: 0;
            overflow-y: auto;
            box-shadow: 2px 0 4px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .admin-main {
            flex: 1;
            margin-left: var(--nav-width);
            padding: 25px;
            background: #f8f9fa;
            min-height: calc(100vh - var(--header-height));
        }

        /* Form styles */
        .form-control {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 141, 0, 0.25);
        }

        .form-label {
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        /* Table styles */
        .table {
            margin-bottom: 1rem;
            background-color: #fff;
            border-radius: 0.375rem;
            overflow: hidden;
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            padding: 0.75rem;
        }

        .table td {
            padding: 0.75rem;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: rgba(0,0,0,0.02);
        }

        /* Card styles */
        .card {
            border: none;
            border-radius: 0.375rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Button styles */
        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #e67e00;
            border-color: #e67e00;
        }

        /* Alert styles */
        .alert {
            border: none;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-nav {
                transform: translateX(-100%);
            }

            .admin-nav.show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
                padding: 1rem;
            }

            .table-responsive {
                margin: 0 -1rem;
            }
        }

        /* Dark Mode Support */
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

            .table {
                background: #2d2d2d;
                color: #fff;
            }

            .table th {
                background: #363636;
                border-color: #404040;
            }

            .table td {
                border-color: #404040;
            }

            .form-control {
                background: #363636;
                border-color: #404040;
                color: #fff;
            }

            .form-control:focus {
                background: #404040;
                border-color: var(--primary-color);
                color: #fff;
            }

            .form-label {
                color: #fff;
            }

            .alert {
                background: #363636;
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

        // Zoom functionality
        let currentZoom = 1;
        const zoomStep = 0.1;
        const maxZoom = 2;
        const minZoom = 0.5;

        function updateZoom() {
            document.documentElement.style.setProperty('--zoom-level', currentZoom);
        }

        function zoomIn() {
            if (currentZoom < maxZoom) {
                currentZoom += zoomStep;
                updateZoom();
            }
        }

        function zoomOut() {
            if (currentZoom > minZoom) {
                currentZoom -= zoomStep;
                updateZoom();
            }
        }

        function resetZoom() {
            currentZoom = 1;
            updateZoom();
        }

        // Mobile menu toggle
        function toggleMobileMenu() {
            document.querySelector('.admin-nav').classList.toggle('show');
        }

        function changeLanguage(lang) {
            // Store the selected language in localStorage
            localStorage.setItem('selectedLanguage', lang);
            
            // Initialize Google Translate
            const googleTranslateElementInit = function() {
                new google.translate.TranslateElement(
                    {
                        pageLanguage: 'en',
                        includedLanguages: lang,
                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                    },
                    'google_translate_element'
                );
            };

            // Load Google Translate script
            const script = document.createElement('script');
            script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            document.body.appendChild(script);
        }

        // Check for saved language preference on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedLang = localStorage.getItem('selectedLanguage');
            if (savedLang) {
                document.getElementById('languageSelect').value = savedLang;
                changeLanguage(savedLang);
            }
        });
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
                <button class="btn btn-link d-md-none text-white" onclick="toggleMobileMenu()">
                    <i class="bi bi-list"></i>
                </button>
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

    <!-- Zoom Controls -->
    <div class="zoom-controls">
        <button class="zoom-btn" onclick="zoomOut()">-</button>
        <button class="zoom-btn" onclick="resetZoom()">Reset</button>
        <button class="zoom-btn" onclick="zoomIn()">+</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
    <!-- View Mode Script -->
    <script src="{{ asset('assets/js/view-mode.js') }}"></script>

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
