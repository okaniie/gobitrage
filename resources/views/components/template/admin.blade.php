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
        }

        body {
            font-size: 18px;
            line-height: 1.6;
            -webkit-text-size-adjust: 100%;
            touch-action: pan-x pan-y;
            -webkit-touch-callout: default;
            -webkit-user-select: text;
            user-select: text;
            zoom: var(--zoom-level);
            -moz-transform: scale(var(--zoom-level));
            -moz-transform-origin: 0 0;
        }

        .admin-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transform-origin: top left;
            transition: transform 0.3s ease;
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
            justify-content: space-between;
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
            transition: transform 0.3s ease;
        }

        .admin-main {
            flex: 1;
            margin-left: var(--nav-width);
            padding: 25px;
            background: #fff;
            min-height: calc(100vh - var(--header-height));
        }

        /* Zoom Controls */
        .zoom-controls {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            gap: 10px;
        }

        .zoom-btn {
            padding: 5px 10px;
            border: none;
            background: #f8f9fa;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .zoom-btn:hover {
            background: #e9ecef;
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

            .form th, .form td {
                border-color: #404040;
            }

            .zoom-controls {
                background: #2d2d2d;
            }

            .zoom-btn {
                background: #404040;
                color: #fff;
            }

            .zoom-btn:hover {
                background: #505050;
            }
        }

        .language-switcher {
            position: relative;
        }
        .language-switcher .form-select {
            background-color: var(--dark-bg);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            padding: 0.25rem 2rem 0.25rem 1rem;
            font-size: 0.9rem;
            cursor: pointer;
            border-radius: 20px;
        }
        .language-switcher .form-select:focus {
            background-color: var(--dark-bg);
            border-color: var(--primary-color);
            color: var(--text-color);
            box-shadow: none;
        }
        .language-switcher .form-select option {
            background-color: var(--dark-bg);
            color: var(--text-color);
        }
        @media (max-width: 768px) {
            .language-switcher {
                margin-bottom: 1rem;
            }
            .language-switcher .form-select {
                width: 100%;
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
            const nav = document.querySelector('.admin-nav');
            nav.classList.toggle('show');
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
                <button class="btn btn-link d-md-none" onclick="toggleMobileMenu()">
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
