@extends('layouts.app')

@section('content')
<style>
    /* ==== PALET WARNA & VARIABEL DESAIN YANG KONSISTEN ==== */
    :root {
        --bg-page: #f3e2c7;
        --ink: #0f172a;
        --muted: #64748b;
        --tbl-head-bg: #f8f9fa;
        --tbl-row-bg: #ffffff;
        --tbl-row-alt: #f6f7f9;     /* Warna untuk baris ganjil (zebra) */
        --tbl-row-hover-bg: #f1f3f5;
        --tbl-border-color: #dee2e6;
        --card-radius: 28px;
        --card-shadow: 0 14px 40px rgba(0, 0, 0, .12);
    }

    /* ==== Latar Belakang Utama ==== */
    body {
        background-color: var(--bg-page);
    }
    main.py-4 {
        background-color: var(--bg-page) !important;
    }

    /* ==== Layout & Kartu ==== */
    .page-container {
        max-width: 1280px;
        margin: auto;
        padding-inline: 16px;
    }
    .data-card {
        background: #fff;
        border-radius: var(--card-radius);
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }
    .data-card .card-header{
        display:flex;
        justify-content:center; 
        align-items:center;   
        gap:8px;
    }
    .data-card .card-header h3{
        margin:0;       
    }
    .data-card .card-body {
        padding: 28px;
    }

    /* ==== Tabel ==== */
    .table {
        border-collapse: separate !important;
        border-spacing: 0;
    }
    .table thead th {
        background-color: var(--tbl-head-bg);
        color: var(--ink);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        padding: 1rem 1.25rem;
        border-bottom: 2px solid var(--tbl-border-color);
    }
    .table tbody td {
        /* INI SOLUSINYA: Beri warna latar eksplisit */
        background-color: var(--tbl-row-bg);
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--tbl-border-color);
        vertical-align: middle;
    }
    /* REKOMENDASI: Tambahkan gaya untuk table-striped */
    .table-striped > tbody > tr:nth-of-type(odd) > * {
        background-color: var(--tbl-row-alt);
    }
    .table-hover tbody tr:hover > * { /* Hover harus lebih kuat dari striped */
        background-color: var(--tbl-row-hover-bg) !important;
    }

    /* ==== Pagination Bootstrap Standar ==== */
    .pagination {
        --bs-pagination-border-radius: 10px;
        --bs-pagination-border-color: var(--tbl-border-color);
        --bs-pagination-color: var(--muted);
        --bs-pagination-bg: var(--tbl-row-bg);
        --bs-pagination-hover-bg: var(--tbl-row-hover-bg);
        --bs-pagination-focus-box-shadow: none;
        --bs-pagination-active-color: #fff;
        --bs-pagination-active-bg: #343a40;
        --bs-pagination-active-border-color: #343a40;
        --bs-pagination-disabled-color: #adb5bd;
        --bs-pagination-disabled-bg: #f8f9fa;
        --bs-pagination-disabled-border-color: var(--tbl-border-color);
    }
    .page-item:not(:first-child) .page-link {
        margin-left: 6px;
    }
    .page-link {
        border-radius: var(--bs-pagination-border-radius) !important;
    }
</style>

<div class="page-container">
    <div class="card data-card">
        <div class="card-header">
            <h3 class="m-3 fw-bold text-center">MANAJEMEN PENGGUNA SELARAS</h3>
        </div>
        <div class="card-body">
            @can('perform-admin-actions')
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-4">
                    Tambah Pengguna Baru
                </a>
            @endcan

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td><span class="badge bg-info text-capitalize">{{ $user->role }}</span></td>
                            <td>
                                @can('perform-admin-actions')
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <!-- <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline form-confirm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                                    </form> -->
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline form-confirm" data-swal-title="Yakin Hapus Pengguna?" data-swal-text="Akun pengguna yang sudah dihapus tidak bisa dikembalikan.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center p-5">Belum ada pengguna.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Jika nanti ada pagination, letakkan di sini --}}
        </div>
    </div>
</div>
@endsection