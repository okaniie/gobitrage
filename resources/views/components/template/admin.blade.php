<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="{{ route('admin.dashboard') }}" />
    <!-- Meta Tags -->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <!-- Page Title -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon and Touch Icons -->
    <link href="{{ asset('admin/img/ch-logo.png') }}" rel="shortcut icon" type="image/png">

    <!--Stylesheet-->
    <link rel="stylesheet" href="{{ asset('admin/css/adminstyle.css') }}" type="text/css" />
</head>

<body class="">
    <center>
        <table width="760" class="header" height="100">
            <tr>
                <td align="center">
                    <a class="link" href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('admin/img/ch-logo.png') }}" alt="" style="height:50px;">
                        <h2>Admin Dashboard</h2>
                    </a>
                </td>
            </tr>
        </table>
        <table width="760" class="body">
            <tr>
                <td width="160" style="border-right:1px solid var(--primary-color)">
                    <x-navigation.admin :slug="$slug"/>
                <td>
                    <x-flash-bag.admin />
                    {{ $slot }}
                </td>
            </tr>
        </table>
        <!-- Footer -->
        <table width="760" class="footer">
            <tr>
                <td>
                    <footer style="text-align: center; padding:10px 0px; margin:0;">
                        Powered by <a target="_blank"
                            href="https://github.com/onumahkalusamuel/gobitrage/">Gobitrage</a>. All Rights
                        Reserved. </p>
                    </footer>
                </td>
            </tr>
        </table>
    </center>
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
    </script>
</body>

</html>
