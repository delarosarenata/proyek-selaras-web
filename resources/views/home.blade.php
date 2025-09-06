@extends('layouts.app')

@section('content')

<style>
    /* 1. Tambahkan background krem ke body */
    body {
        background-color: #f3e2c7;
    }

    /* Bikin konten ke tengah layar */
    main {
        min-height: calc(100vh - 110px); /* sisakan buat header+footer */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* 2. Disesuaikan agar gaya kartu konsisten dengan desain lain */
    .dashboard-card {
        background: #ffffff;
        border-radius: 28px; /* Dibuat lebih bulat */
        box-shadow: 0 14px 40px rgba(0, 0, 0, .12); /* Bayangan lebih halus & tebal */
        overflow: hidden;
    }
    .dashboard-card .card-header {
        background: transparent;
        border-bottom: 1px solid #f0f0f0;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 1.25rem 1.75rem; /* Sedikit padding tambahan */
    }
    .dashboard-card .card-body {
        padding: 1.75rem;
        font-size: 1rem;
        color: #374151;
    }
    .alert {
        border-radius: 12px;
        padding: .75rem 1rem;
        margin-bottom: 1rem;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card dashboard-card">
                <div class="card-header">{{ __('Selamat Datang!') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Anda sudah berhasil untuk login.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection