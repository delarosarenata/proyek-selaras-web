@extends('layouts.app')
@section('title', 'SELARAS BPS PINRANG')

@section('content')
<style>
    :root {
        /* Warna dari halaman Kuesioner */
        --bg-krem: #f3e2c7;
        --ink: #0f172a;
        --muted: #6b7280;

        /* Warna Merah Khas Landing Page (CTA) */
        --cta: #ef3b4a;
        --cta-dark: #d61f69;
        --cta-ring: rgba(239, 59, 74, .35); /* Shadow untuk tombol merah */
    }

    /* Mengambil background krem dari halaman kuesioner */
    body {
        background: var(--bg-krem);
    }

    /* STRUKTUR UTAMA: Mengadopsi dari halaman kuesioner */
    /* .hero-section {
        padding: 20px 0 20px;
    } */
    /* @media (min-width:992px) {
        .hero-section {
            padding-top: 72px;
            padding-bottom: 72px;
        }
    } */

    /* CARD: Mengambil gaya kartu dari kuesioner */
    .hero-card {
        background: #fff;
        border-radius: 28px;
        box-shadow: 0 14px 40px rgba(0, 0, 0, .12);
        max-width: 1140px; /* Lebar disesuaikan untuk 2 kolom */
        margin-inline: auto;
    }
    .hero-card .inner {
        padding: 48px 28px;
    }
    @media (min-width:992px) {
        .hero-card .inner {
            padding: 56px 64px;
        }
    }

    /* TYPOGRAPHY: Mengadopsi gaya teks dari kuesioner tapi sedikit disesuaikan */
    .hero-eyebrow {
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--cta-dark); /* Pakai warna merah/pink */
        font-size: .9rem;
        margin-bottom: .5rem;
    }
    .hero-title {
        color: var(--ink);
        font-weight: 800;
        line-height: 1.2;
        font-size: clamp(1.9rem, 2.4vw + 1.4rem, 2.9rem);
    }
    .hero-sub {
        color: var(--muted);
        font-weight: 700;
        font-size: clamp(1rem, .6vw + .9rem, 1.25rem);
        margin-top: .5rem;
    }
    .hero-lead {
        color: #374151;
        font-size: clamp(1rem, .5vw + .9rem, 1.15rem);
        line-height: 1.8;
        max-width: 45ch; /* Batasi lebar teks agar mudah dibaca */
    }

    /* TOMBOL: Mengadopsi gaya tombol kuesioner tapi dengan WARNA MERAH */
    .btn-cta {
        background: var(--cta);
        color: #fff;
        border: none;
        padding: 16px 28px;
        font-size: clamp(1rem, .5vw + .9rem, 1.1rem);
        font-weight: 700;
        border-radius: 14px;
        transition: .2s ease;
        box-shadow: 0 8px 20px var(--cta-ring);
        text-decoration: none;
        display: inline-block; /* Agar bisa diberi style */
        margin-top: 16px;
    }
    .btn-cta:hover {
        background: var(--cta-dark);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ILUSTRASI KANAN: Mirip seperti sebelumnya */
    .art {
        width: 100%;
        max-width: 480px;
        aspect-ratio: 4/3;
        border-radius: 18px;
        display: grid;
        place-items: center;
        color: #9ca3af;
        font-weight: 600;
        background: linear-gradient(135deg, #f8fafc, #ffffff);
        border: 2px dashed #d1d5db;
        margin-inline: auto; /* Center di mobile */
    }

    /* RESPONSIVE: Di mobile, semua jadi satu kolom dan text-center */
    @media (max-width: 991.98px) {
        .hero-card .inner {
            text-align: center;
        }
        .hero-lead {
            margin-inline: auto; /* Center juga paragrafnya */
        }
        .text-lg-start {
             text-align: center !important;
        }
    }

    img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 18px; 
    }

</style>

<section class="hero-section">
    <div class="container">
        <div class="hero-card">
            <div class="inner">
                <div class="row align-items-center g-5">
                    
                    <div class="col-lg-6 text-center text-lg-start">
                        <div class="hero-eyebrow">SELARAS - BPS KABUPATEN PINRANG</div>
                        <h1 class="hero-title">Sistem Penilaian Pelayanan dan Respon Statistik</h1>
                        <h4 class="hero-sub">BPS Kabupaten Pinrang</h4>
                        <p class="hero-lead mt-3">
                            Selamat datang di <strong>SELARAS</strong> — platform pemantauan penilaian pelayanan statistik di BPS Kabupaten Pinrang.
                        </p>
                        <!-- <a href="{{ route('login') }}" class="btn-cta">Masuk</a> -->
                         @guest
                            {{-- Jika pengguna adalah "tamu" (belum login), tampilkan tombol Masuk --}}
                            <a href="{{ route('login') }}" class="btn-cta">Masuk</a>
                        @else
                            {{-- Jika pengguna sudah login, tampilkan tombol menuju Dashboard Monitoring --}}
                            <a href="{{ route('admin.monitoring') }}" class="btn-cta">Lanjutkan ke Dashboard</a>
                        @endguest
                    </div>

                    <div class="col-lg-6">
                        <div class="">
                        <!-- <div class="art">[ Gambar / Ilustrasi ]</div> -->
                         <img src="{{ asset('images/beranda.jpg') }}" alt="Beranda" class="img-fluid rounded">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection