<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ $title }} - Admin Panel</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ secure_asset('admin/img/ch-logo.png') }}" type="image/png">

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
    <!-- Preload Critical Assets -->
    <link rel="preload" href="{{ secure_asset('admin/css/adminstyle.css') }}" as="style">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('admin/css/adminstyle.css') }}">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
    <!-- View Mode Script -->
    <script src="{{ asset('assets/js/view-mode.js') }}"></script>

    <!-- Begin of Chaport Live Chat code -->
    <script type="text/javascript">
    (function(w,d,v3){
    w.chaportConfig = {
      appId : '67eb37fb4492a3ec53055f19'
    };

    if(w.chaport)return;v3=w.chaport={};v3._q=[];v3._l={};v3.q=function(){v3._q.push(arguments)};v3.on=function(e,fn){if(!v3._l[e])v3._l[e]=[];v3._l[e].push(fn)};var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://app.chaport.com/javascripts/insert.js';
    
    // Add error handling
    s.onerror = function() {
        console.error('Failed to load Chaport chat script');
    };
    
    s.onload = function() {
        console.log('Chaport chat script loaded successfully');
    };
    
    var ss=d.getElementsByTagName('script')[0];ss.parentNode.insertBefore(s,ss)})(window, document);
    </script>
    <!-- End of Chaport Live Chat code -->

    <script>
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
</body>

</html>
