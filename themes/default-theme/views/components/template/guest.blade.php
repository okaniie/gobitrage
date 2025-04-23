<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/html;" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Gobitrage - Your Trusted Investment Platform</title>

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
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
    
    <!-- google translate -->
    <style type="text/css">
        .goog-logo-link {
            display: none !important;
        }
        .goog-te-gadget {
            color: transparent !important;
        }
        .goog-te-gadget .goog-te-combo {
            color: var(--text-color) !important;
        }
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
        body {
            top: 0px !important;
        }
    </style>

    {{-- <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script> --}}
    {{-- <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> --}}

    @if (\App\Models\Setting::get('google_track_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={$sysSettings.googleTrackId}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', "{{ \App\Models\Setting::get('google_track_id') }}");
        </script>
    @endif
    {{-- {{ \App\Models\Setting::get('header_code') }} --}}

    <style>
        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #00ff88;
            --accent-color: #ff3366;
            --text-color: #ffffff;
            --dark-bg: #0a0a0a;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            line-height: 1.6;
            background-color: var(--dark-bg);
            /* color: var(--text-color); */
            /* transform-origin: top left; */
            margin: 0;
        }


        /* Very small screens (e.g., smartwatches, very old phones) */
@media (max-width: 320px) {
    .content-wrapper {
        transform: scale(0.3); /* Adjust scaling as needed */
        width: 333.33%; /* 100/0.3 */
        /* height: 333.33%;  */
    }
}

/* Small phones (e.g., iPhone SE, older Android phones) */
@media (min-width: 321px) and (max-width: 480px) {
    .content-wrapper {
        transform: scale(0.4); /* Adjust scaling as needed */
        width: 250%; /* 100/0.4 */
        /* height: 250%;  */
    }
}

/* Standard phones (e.g., most modern smartphones) */
@media (min-width: 481px) and (max-width: 900px) {
    .content-wrapper {
        transform: scale(0.5); /* Adjust scaling as needed */
        width: 200%; /* 100/0.5 */
        /* height: 200%; / */
    }
}

/* Tablets and larger phones */
@media (min-width: 900px) {
    /* Optional: You might not need scaling here, or adjust as needed */
    .content-wrapper {
        transform: scale(1);
        width: 100%;
        /* height: 100%; */
    }
}
        
        .navbar {
            background-color: var(--primary-color) !important;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        
        .navbar-brand {
            color: var(--secondary-color) !important;
            font-size: 1.5rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            color: var(--accent-color) !important;
            transform: scale(1.05);
        }
        
        .nav-link {
            color: var(--text-color) !important;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--secondary-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            transform: translateY(-2px);
        }
        
        .hero-section {
            background: linear-gradient(rgba(26, 26, 26, 0.9), rgba(26, 26, 26, 0.9)), url('/assets/images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            color: var(--text-color);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0, 255, 136, 0.1), rgba(255, 51, 102, 0.1));
            animation: gradientAnimation 10s ease infinite;
        }
        
        .feature-box {
            text-align: center;
            padding: 30px;
            margin-bottom: 30px;
            background: var(--primary-color);
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 255, 136, 0.2);
        }
        
        .feature-box i {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .feature-box:hover i {
            transform: scale(1.2);
            color: var(--accent-color);
        }
        
        .footer {
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 50px 0;
        }
        
        .footer a {
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer a:hover {
            color: var(--secondary-color);
        }
        
        /* Animations */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.6s ease;
        }
        
        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.6s ease;
        }
        
        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scale-in {
            opacity: 0;
            transform: scale(0.9);
            transition: all 0.6s ease;
        }
        
        .scale-in.visible {
            opacity: 1;
            transform: scale(1);
        }
    </style>

</head>

<body>
    <main class="content-wrapper">
    <x-navigation.guest />
    <x-general.crypto-ticker />
        <div class="main-content">
            <div id="google_translate_element"></div>
            {{ $slot }}
        </div>
        <x-footer.guest />
    </main>

    <!--
      Javascript Files
      ==================================================
      -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
    <!-- View Mode Script -->
    <script src="{{ asset('assets/js/view-mode.js') }}"></script>
    
    {{ \App\Models\Setting::get('footer_code') }}

    <!--Body Inner end-->
    <script>
        // Intersection Observer for animations
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            // Observe all elements with animation classes
            document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'google_translate_element'
            );
        }
    </script>

    <script type="text/javascript" 
            src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
</body>

</html>
