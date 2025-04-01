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
                <div class="header-right">
                    <div class="theme-toggle">
                        <button class="btn btn-link" onclick="toggleTheme()">
                            <i class="bi bi-moon-stars"></i>
                        </button>
                    </div>
                    <button class="btn btn-link d-md-none text-white" onclick="toggleMobileMenu()">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="admin-body">
            <nav class="admin-nav">
                <x-navigation.admin :slug="$slug"/>
            </nav>
            
            <main class="admin-main">
                <div class="main-content">
                    <x-flash-bag.admin />
                    {{ $slot }}
                </div>
            </main>
        </div>

        <footer class="admin-footer">
            <div class="footer-content">
                <p class="mb-0">Powered by <a href="https://github.com/onumahkalusamuel/gobitrage/" target="_blank" rel="noopener">Gobitrage</a>. All Rights Reserved.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
    <!-- View Mode Script -->
    <script src="{{ asset('assets/js/view-mode.js') }}"></script>

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

        function toggleTheme() {
            document.body.classList.toggle('dark-theme');
            const icon = document.querySelector('.theme-toggle i');
            icon.classList.toggle('bi-moon-stars');
            icon.classList.toggle('bi-sun');
        }

        // Check for saved theme preference
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-theme');
                document.querySelector('.theme-toggle i').classList.replace('bi-moon-stars', 'bi-sun');
            }
        });
    </script>

    <style>
    :root {
        --primary-color: #4f46e5;
        --secondary-color: #6b7280;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
        --info-color: #3b82f6;
        --background-color: #ffffff;
        --text-color: #1f2937;
        --border-color: #e5e7eb;
        --card-background: #ffffff;
        --nav-background: #f9fafb;
    }

    .dark-theme {
        --primary-color: #6366f1;
        --secondary-color: #9ca3af;
        --success-color: #34d399;
        --danger-color: #f87171;
        --warning-color: #fbbf24;
        --info-color: #60a5fa;
        --background-color: #111827;
        --text-color: #f9fafb;
        --border-color: #374151;
        --card-background: #1f2937;
        --nav-background: #111827;
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .admin-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .admin-header {
        background-color: var(--card-background);
        border-bottom: 1px solid var(--border-color);
        padding: 1rem;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1400px;
        margin: 0 auto;
    }

    .logo-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: var(--text-color);
    }

    .logo {
        height: 40px;
        margin-right: 1rem;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .theme-toggle .btn-link {
        color: var(--text-color);
        text-decoration: none;
        padding: 0.5rem;
    }

    .admin-body {
        display: flex;
        flex: 1;
        overflow: hidden;
    }

    .admin-nav {
        width: 280px;
        background-color: var(--nav-background);
        border-right: 1px solid var(--border-color);
        overflow-y: auto;
        transition: transform 0.3s ease;
    }

    .admin-main {
        flex: 1;
        overflow-y: auto;
        padding: 2rem;
    }

    .main-content {
        max-width: 1400px;
        margin: 0 auto;
    }

    .admin-footer {
        background-color: var(--card-background);
        border-top: 1px solid var(--border-color);
        padding: 1rem;
        text-align: center;
    }

    .footer-content {
        max-width: 1400px;
        margin: 0 auto;
        color: var(--secondary-color);
    }

    .footer-content a {
        color: var(--primary-color);
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .admin-nav {
            position: fixed;
            left: -280px;
            height: 100vh;
            z-index: 999;
        }

        .admin-nav.show {
            transform: translateX(280px);
        }

        .admin-main {
            padding: 1rem;
        }
    }
    </style>
</body>

</html>
