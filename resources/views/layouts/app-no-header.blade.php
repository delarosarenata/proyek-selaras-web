<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SELARAS BPS PINRANG')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bps-blue: #0d6efd;
            --navbar-bg: #212529; /* Warna gelap untuk navbar */
            --navbar-link-color: rgba(255, 255, 255, 0.75);
            --navbar-link-hover-color: #ffffff;
            --navbar-link-active-bg: #0d6efd;
        }
        html, body {
            height: 100%; /* Pastikan html dan body mengisi seluruh tinggi layar */
        }
        body {
            /* padding-top: 70px; Sesuaikan angka ini jika tinggi navbar Anda berbeda */
            display: flex;
            flex-direction: column;
            /* min-height: 100vh; */
            background-color: #f8f9fa;
        }
        #app {
            flex: 1;
        }
        .main-navbar {
            background-color: var(--navbar-bg) !important;
        }
        .main-navbar .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .main-navbar .nav-link {
            color: var(--navbar-link-color) !important;
            font-weight: 500;
            padding: 0.8rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease-in-out;
        }
        .main-navbar .nav-link:hover {
            color: var(--navbar-link-hover-color) !important;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .main-navbar .nav-link.active {
            color: var(--navbar-link-hover-color) !important;
            background-color: var(--navbar-link-active-bg);
        }
        .main-navbar .dropdown-menu {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        main.app-main {
            flex: 1 0 auto; /* Ini akan "mendorong" footer ke bawah */
        }
        footer.app-footer {
            flex-shrink: 0;
        }
    </style>
</head>

<body>
    <!-- PERHATIKAN: id="app" sudah dihapus dari sini -->
    <!-- <div> -->

        <!-- Content -->
        <main class="container py-4 app-main">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="text-center py-3 bg-dark text-white-50 app-footer">
        <p class="mb-0">&copy; {{ date('Y') }} Made with ❤️ by BPS Kabupaten Pinrang</p>
    </footer>
    <!-- </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts') 
</body>

</html>