<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SELARAS BPS PINRANG')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="app">
    <!-- PERHATIKAN: id="app" sudah dihapus dari sini -->
    <div>

        <!-- Content -->
        <main class="container py-4 app-main">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="text-center mt-auto py-3 bg-light app-footer">
            <p class="mb-0">&copy; {{ date('Y') }} Made with 🖤 by BPS Kabupaten Pinrang</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts') 
</body>

</html>