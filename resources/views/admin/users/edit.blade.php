@extends('layouts.app')

@section('content')
<style>
    /* ==== PALET WARNA & VARIABEL DESAIN YANG KONSISTEN ==== */
    :root {
        --bg-page: #f3e2c7;
        --ink: #0f172a;
        --muted: #64748b;
        --border-color: #dee2e6;
        --focus-ring: rgba(52, 58, 64, 0.15); /* Cincin fokus abu-abu */
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
    .form-card {
        background: #fff;
        border-radius: var(--card-radius);
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }
    .form-card .card-header {
        background: transparent;
        border-bottom: 1px solid var(--border-color);
        font-weight: 700;
        font-size: 1.5rem;
        padding: 20px 28px;
    }
    .form-card .card-body {
        padding: 28px;
    }

    /* ==== Gaya Formulir Modern ==== */
    .form-label {
        font-weight: 600;
        color: var(--ink);
    }
    .form-control, .form-select {
        background-color: #fff !important;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #343a40;
        box-shadow: 0 0 0 3px var(--focus-ring);
    }

    /* ==== Penataan Tombol Aksi ==== */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 1.5rem;
    }
    .btn {
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
    }
</style>

<div class="page-container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card form-card">
                <div class="card-header">
                    <h3 class="m-0">Edit Pengguna: {{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required>
                             @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            {{-- Tipe input diubah menjadi 'password' untuk keamanan --}}
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin diubah">
                             @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            {{-- BAGIAN YANG MENAMPILKAN PASSWORD LAMA SUDAH DIHAPUS KARENA TIDAK AMAN --}}
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="petugas" @if(old('role', $user->role) == 'petugas') selected @endif>Petugas</option>
                                <option value="admin" @if(old('role', $user->role) == 'admin') selected @endif>Admin</option>
                                <option value="supervisor" @if(old('role', $user->role) == 'supervisor') selected @endif>Supervisor</option>
                            </select>
                             @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection