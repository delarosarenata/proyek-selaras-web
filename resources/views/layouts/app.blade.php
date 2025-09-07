<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SELARAS')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/sass/app.scss'])

    <style>
        :root {
            --bps-blue: #0d6efd;
            --navbar-bg: #212529; /* Warna gelap untuk navbar */
            --navbar-link-color: rgba(255, 255, 255, 0.75);
            --navbar-link-hover-color: #ffffff;
            --navbar-link-active-bg: #0d6efd;
        }
        body {
            padding-top: 70px; /* Sesuaikan angka ini jika tinggi navbar Anda berbeda */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm main-navbar fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-chart-bar me-2"></i>SELARAS
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            @endif
                        @else
                            @can('view-admin-pages')
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.introduce') }}">Kuesioner</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.monitoring') }}">Monitoring</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.responden') }}">Responden</a></li>
                            @endcan
                            @can('view-user-management')
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Manajemen User</a></li>
                            @endcan
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" data-bs-auto-close="outside">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
    <footer class="text-center mt-auto py-3 bg-dark text-white-50">
        <p class="mb-0">&copy; {{ date('Y') }} Made with ❤️ by BPS Kabupaten Pinrang</p>
    </footer>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Bootstrap JS (dari CDN agar pasti jalan) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    @stack('scripts')

    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const navCollapse = document.getElementById('navbarSupportedContent');
    const toggler = document.querySelector('.navbar-toggler');

    // Tutup kalau klik di luar navbar collapse & toggler
    document.addEventListener('click', function (e) {
      const clickInside =
        navCollapse.contains(e.target) || toggler.contains(e.target);
      if (navCollapse.classList.contains('show') && !clickInside) {
        bootstrap.Collapse.getInstance(navCollapse)?.hide();
      }
    });

    // 1) JANGAN tutup saat klik tombol dropdown (profil)
    // 2) TUTUP saat klik nav-link biasa atau item dropdown
    navCollapse.querySelectorAll('.nav-link:not(.dropdown-toggle), .dropdown-item')
      .forEach(el => {
        el.addEventListener('click', () => {
          if (navCollapse.classList.contains('show')) {
            bootstrap.Collapse.getInstance(navCollapse)?.hide();
          }
        });
      });

    // Opsional: tutup dengan ESC
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && navCollapse.classList.contains('show')) {
        bootstrap.Collapse.getInstance(navCollapse)?.hide();
      }
    });

    const confirmForms = document.querySelectorAll('.form-confirm');
        confirmForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Hentikan pengiriman form asli
                
                const title = this.dataset.swalTitle || 'Apakah Anda Yakin?';
                const text = this.dataset.swalText || 'Tindakan ini tidak bisa dibatalkan.';

                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, lanjutkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Jika dikonfirmasi, kirim form
                    }
                });
            });
        });

  });
</script>

</body>
</html>