@extends('layouts.app')

@section('title', 'Dashboard Monitoring')

@section('content')
<style>
    /* ==== PALET WARNA & VARIABEL DESAIN YANG KONSISTEN ==== */
    :root {
        --bg-page: #f3e2c7;         /* Latar krem yang sama dengan halaman lain */
        --ink: #0f172a;             /* Teks utama */
        --muted: #64748b;           /* Teks sekunder */

        /* Warna untuk Tabel */
        --tbl-head-bg: #f8f9fa;      /* Header tabel abu-abu sangat muda */
        --tbl-row-bg: #ffffff;      /* Baris tabel putih */
        --tbl-row-hover-bg: #f1f3f5; /* Warna baris saat disentuh mouse */
        --tbl-border-color: #dee2e6; /* Warna garis batas */

        /* Properti Desain Kartu (disamakan dengan halaman lain) */
        --card-radius: 28px;
        --card-shadow: 0 14px 40px rgba(0, 0, 0, .12);
    }

    /* ==== 1. Latar Belakang Utama ==== */
    body {
        background-color: var(--bg-page);
    }
    main.py-4 {
        background-color: var(--bg-page) !important;
    }

    /* ==== 2. Layout & Header Halaman ==== */
    .dashboard-container {
        max-width: 1280px;
        margin: auto; /* Jarak atas-bawah gausah pake 40px*/
        padding-inline: 16px;
    }
    .dash-header {
        background: #fff;
        /* border-radius: var(--card-radius); */
        border-radius: 15px;
        padding: 20px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        box-shadow: var(--card-shadow);
        margin-bottom: 24px;
    }
    .dash-title {
        margin: 0;
        font-weight: 800;
        color: var(--ink);
        font-size: 1.5rem;
    }

    /* ==== 3. KARTU PEMBUNGKUS TABEL (Desain Konsisten) ==== */
    .table-card {
        background: #fff;
        /* border-radius: var(--card-radius); */
        border-radius: 15px;
        box-shadow: var(--card-shadow);
        overflow: hidden; /* Penting agar tabel mengikuti radius kartu */
    }

    /* ==== 4. PERBAIKAN TABEL DATATABLES (Biar Gak Aneh) ==== */
    .table-responsive {
        padding: 8px;
    }
    #monitoringTable {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0;
    }
    #monitoringTable thead th {
        background-color: var(--tbl-head-bg) !important;
        color: var(--ink) !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.8rem;
        padding: 1rem 1.25rem;
        border-bottom: 2px solid var(--tbl-border-color) !important;
    }
    #monitoringTable tbody td {
        background-color: var(--tbl-row-bg);
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--tbl-border-color);
        vertical-align: middle;
    }
    #monitoringTable.table-hover > tbody > tr:hover > * {
        background-color: var(--tbl-row-hover-bg) !important;
    }

    /* ==== 5. KONTROL DATATABLES (Search, Paging, dll) ==== */
    .dt-toolbar, .dt-bottom-toolbar {
        padding: 12px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .dataTables_length label, .dataTables_filter label {
        color: var(--muted);
        font-weight: 600;
        margin-bottom: 0;
    }
    .dataTables_filter input, .dataTables_length select {
        border: 1px solid var(--tbl-border-color);
        border-radius: 10px;
        padding: 8px 12px;
        background: #fff;
        margin-left: 8px;
    }
    .dataTables_info {
        color: var(--muted);
        padding-top: 0.85em;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5em 1em !important;
        margin: 0 4px !important;
        border-radius: 10px !important;
        border: 1px solid var(--tbl-border-color) !important;
        background: #fff !important;
        color: var(--muted) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--tbl-row-hover-bg) !important;
        border-color: #c0c6cd !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #343a40 !important;
        color: #fff !important;
        border-color: #343a40 !important;
    }

    /* ==== 6. BARU: PERBAIKAN PAGINATION BOOTSTRAP STANDAR (Untuk gambar yg kamu kirim) ==== */
    .pagination {
        --bs-pagination-border-radius: 5px;
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
        margin-left: 6px; /* Beri jarak antar tombol */
    }
    .page-link {
        border-radius: var(--bs-pagination-border-radius) !important;
    }
    .dataTables_wrapper .dt-bottom-toolbar {
        display: flex;
        flex-wrap: wrap; /* Izinkan item untuk turun ke baris baru */
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
    }

    .dataTables_info {
        padding-bottom: 1rem; /* Beri jarak jika pagination turun baris */
    }

    .dataTables_paginate {
        width: 100%;
        text-align: center; /* Pusatkan tombol pagination */
    }
    
</style>

<div class="dashboard-container">
    <div class="dash-header">
        <h3 class="dash-title">Dashboard Monitoring Pengisian</h3>
        <form action="{{ route('admin.monitoring.sync') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Sinkronkan Buku Tamu</button>
        </form>
    </div>

    <div class="table-card">
        @if(session('success'))
            <div class="alert alert-success m-3 mb-0">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table id="monitoringTable" class="table table-hover align-middle">
                <thead style="vertical-align: middle;">
                    <tr >
                        <th class="text-center">#</th>
                        <th class="text-center">Nama Tamu (dari buku tamu)</th>
                        <th class="text-center">Detail Layanan yang Diinginkan</th>
                        <th class="text-center">Tanggal Kunjungan</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Status SKD</th>
                        <th>Keterangan</th>
                        <th class="text-center">Tanggal Isi SKD</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($monitoringData as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td title="{{ $data->nama_lengkap }}">{{ $data->nama_lengkap }}</td>
                            <td title="{{ $data->detail_layanan }}">{{ Str::limit($data->detail_layanan, 30) }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->timestamp)->format('d M Y') }}</td>
                            <td title="{{ $data->email }}">{{ Str::limit($data->email, 10) }}</td>
                            <td class="text-center">
                                @if($data->status_pengisian == 'Sudah Mengisi')
                                    <span class="badge bg-success">{{ $data->status_pengisian }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $data->status_pengisian }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $data->keterangan }}
                            </td>
                            <td>
                                @if($data->tanggal_pengisian_skd)
                                    {{ $data->tanggal_pengisian_skd->format('d M Y, H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted p-5">Data buku tamu belum disinkronkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Pastikan jQuery dan DataTables sudah di-load sebelum script ini
    $(function () {
        $('#monitoringTable').DataTable({
            responsive: true,
            pagingType: "simple_numbers",
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
            order: [[0, 'asc']],
            language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
            // DOM diatur agar lebih rapi
            dom:
                "<'dt-toolbar'<'dt-length'l><'dt-search'f>>" +
                "<'table-responsive't>" + // 't' adalah tabel itu sendiri
                "<'dt-bottom-toolbar'<'dt-info'i><'dt-paging'p>>"
            
        });
    });
</script>
@endpush