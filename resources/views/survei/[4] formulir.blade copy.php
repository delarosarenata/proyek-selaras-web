@extends('layouts.app-no-header')

@section('title', 'Formulir Survei Penilaian Pelayanan')

@section('content')

<style>
    /* --- Google Font (Opsional, tapi memberikan sentuhan modern) --- */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    /* --- Variabel Warna & Style Global (EYE-FRIENDLY) --- */
    :root {
        --primary-color: #4A90E2;
        /* Biru yang lebih lembut */
        --bg-page: #1B3C53;
        /* Latar belakang halaman (abu-abu sangat muda, tidak putih) */
        --bg-card: #ffffff;
        /* Warna card tetap putih bersih untuk fokus */
        --border-color: #e0e0e0;
        /* Warna border yang lebih halus */
        --text-primary: #333333;
        /* Warna teks utama (abu-abu gelap, bukan hitam pekat) */
        --text-secondary: #545252ff;
        /* Warna teks sekunder (abu-abu medium) */
        --shadow: 0 4px 25px rgba(0, 0, 0, 0.06);
        /* Shadow yang sangat halus */
        --border-radius: 0.5rem;
    }

    /* --- Style Body & Layout Utama --- */
    body {
        background-color: var(--bg-page);
        color: var(--text-primary);
        font-family: 'Inter', sans-serif;
    }

    .card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .card-header {
        background: var(--primary-color);
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }

    .card-header h4 {
        font-weight: 700;
        color: white;
    }

    .card-body {
        padding: 2.5rem;
    }

    /* --- Progress Bar --- */
    .progress {
        height: 28px;
        border-radius: var(--border-radius);
        background-color: #e9ecef;
    }

    .progress-bar {
        font-size: 0.9rem;
        font-weight: 600;
        background-color: var(--primary-color);
    }

    /* --- Style Elemen Form --- */
    .form-label {
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        background-color: #fff;
        color: var(--text-primary);
        border-radius: var(--border-radius);
        border: 1px solid var(--border-color);
        padding: 0.75rem 1rem;
        transition: all 0.2s ease-in-out;
    }

    .form-control::placeholder {
        color: #b0b0b0;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.15);
        outline: none;
    }

    /* --- Tombol Aksi --- */
    .btn {
        border-radius: var(--border-radius);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-primary {
        background-color: var(--primary-color);
    }

    .btn:hover {
        transform: translateY(-2px);
        filter: brightness(1.1);
    }

    /* --- Komponen Kustom: Skala Penilaian 1-10 --- */
    .scale-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 5px;
    }

    .scale-item {
        cursor: pointer;
        border: 2px solid var(--border-color);
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
        background-color: #fff;
        color: var(--text-secondary);
    }

    .scale-item:hover {
        transform: scale(1.1);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .scale-item.scale-selected {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: scale(1.15);
        box-shadow: 0 0 15px rgba(74, 144, 226, 0.4);
    }

    .rating-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text-secondary);
        white-space: normal;
        /* Kunci utamanya: mengizinkan teks untuk turun baris */
        line-height: 1.4;
        /* Atur jarak antar baris jika teksnya turun */
        text-align: left;
        /* Pastikan teks rata kiri saat turun baris */
        display: inline-block;
        /* Pastikan elemen bisa diatur lebarnya */
        max-width: 100%;
        /* Batasi lebar maksimal agar tidak keluar card */
        margin-bottom: 8px;
        /* Beri sedikit jarak ke barisan tombol di bawahnya */
    }

    /* --- Wrapper untuk Input "Lainnya" --- */
    .lainnya-input-wrapper {
        display: none;
        margin-top: 10px;
    }

    /* --- Style Tabel di Blok 3 --- */
    .table {
        --bs-table-color: var(--text-primary);
        --bs-table-bg: var(--bg-card);
        --bs-table-border-color: var(--border-color);
        --bs-table-striped-color: var(--text-primary);
        --bs-table-striped-bg: #fbfdff;
        /* Striping yang sangat halus */
        --bs-table-hover-color: var(--text-primary);
        --bs-table-hover-bg: #f8faff;
    }

    .table-light {
        --bs-table-color: var(--text-primary);
        --bs-table-bg: #f3f4f6;
        --bs-table-border-color: var(--border-color);
    }

    #kebutuhanDataTableBody .btn-sm {
        padding: 0.2rem 0.5rem;
        font-size: 0.8rem;
    }

    /* --- Media Query untuk Tampilan Responsif (Layar Kecil) --- */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
            /* Kurangi padding di layar kecil agar tidak sempit */
        }

        /* Penyesuaian untuk skala penilaian */
        .scale-container {
            flex-wrap: wrap;
            /* Izinkan tombol untuk pindah ke baris baru */
            justify-content: center;
            /* Pusatkan tombol-tombolnya */
            gap: 8px;
            /* Atur jarak antar tombol saat di layar kecil */
        }

        .scale-item {
            width: 40px;
            /* Sedikit perkecil ukuran tombol */
            height: 40px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {

        /* Penyesuaian lebih lanjut untuk layar sangat kecil (HP) */
        .scale-item {
            width: 38px;
            height: 38px;
        }

        .scale-container {
            gap: 5px;
            /* Perkecil lagi jaraknya */
        }

        .card-header h4 {
            font-size: 1.25rem;
        }

        .card-body {
            padding: 1.5rem 1rem;
        }
    }
</style>

<div class="container my-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Survei Penilaian Pelayanan Statistik Terpadu</h4>
                </div>
                <div class="card-body p-4">
                    <div class="progress mb-4" style="height: 25px;">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">BLOK I</div>
                    </div>

                    <form action="{{ route('kuesioner.store') }}" method="POST" id="surveyForm">

                        @csrf

                        <!-- {{-- TAMBAHKAN BLOK INI UNTUK MENAMPILKAN ERROR --}} -->
                        @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <h5 class="alert-heading">Terjadi Kesalahan!</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- {{-- AKHIR BLOK ERROR --}} -->

                        <input type="hidden" name="kebutuhan_data_json" id="kebutuhan_data_json">

                        <!-- {{-- ================================================================== --}}
                        {{-- =                               BLOK I                           = --}}
                        {{-- ================================================================== --}} -->
                        <div id="block-1" class="survey-block">
                            <h5 class="mb-3">BLOK I. Keterangan Responden</h5>

                            <div class="mb-3">
                                <label for="nama" class="form-label fw-bold">1. Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">2. E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label fw-bold">3. No. Handphone</label>
                                <input type="tel" class="form-control" id="no_hp" name="no_hp" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block fw-bold">4. Jenis Kelamin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki" required>
                                    <label class="form-check-label" for="laki_laki">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">5. Pendidikan Tertinggi yang Ditamatkan</label>
                                <select class="form-select" name="pendidikan_id" required>
                                    <option value="" selected disabled>-- Pilih salah satu --</option>
                                    <option value="1">
                                        <= SLTA/Sederajat</option>
                                    <option value="2">D1/D2/D3</option>
                                    <option value="3">D4/S1</option>
                                    <option value="4">S2</option>
                                    <option value="5">S3</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="pekerjaan_id" class="form-label">6. Pekerjaan Utama</label>
                                <select class="form-select" name="pekerjaan_id" id="pekerjaan_id" required>
                                    <option value="" selected disabled>-- Pilih salah satu --</option>
                                    <option value="1">Pelajar/Mahasiswa</option>
                                    <option value="2">Peneliti/Dosen</option>
                                    <option value="3">ASN/TNI/POLRI</option>
                                    <option value="4">Pegawai BUMN/BUMD</option>
                                    <option value="5">Pegawai Swasta</option>
                                    <option value="6">Wiraswasta</option>
                                    <option value="7">Lainnya</option>
                                </select>
                                <div class="lainnya-input-wrapper" id="pekerjaan_lainnya_wrapper">
                                    <input type="text" class="form-control form-control-sm" name="pekerjaan_lainnya" placeholder="Sebutkan lainnya...">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="instansi_id" class="form-label fw-bold">7. Kategori Instansi </label>
                                <select class="form-select" name="instansi_id" id="instansi_id" required>
                                    <option selected disabled value="">-- Pilih salah satu --</option>
                                    <option value="1">Lembaga Negara</option>
                                    <option value="2">Kementerian & Lembaga Pemerintah</option>
                                    <option value="3">TNI/POLRI/BIN/Kejaksaan</option>
                                    <option value="4">Pemerintah Daerah</option>
                                    <option value="5">Lembaga Internasional</option>
                                    <option value="6">Lembaga Penelitian & Pendidian</option>
                                    <option value="7">BUMN/BUMD</option>
                                    <option value="8">Swasta</option>
                                    <option value="9">Lainnya</option>
                                </select>
                                <div class="lainnya-input-wrapper" id="instansi_lainnya_wrapper">
                                    <input type="text" class="form-control form-control-sm" name="instansi_lainnya" placeholder="Sebutkan lainnya...">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nama_instansi" class="form-label fw-bold">8. Nama Instansi</label>
                                <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" required>
                            </div>

                            <div class="mb-3">
                                <label for="pemanfaatan_id" class="form-label fw-bold">9. Pemanfaatan Utama Hasil Kunjungan dan/atau Akses Layanan</label>
                                <select class="form-select" name="pemanfaatan_id" id="pemanfaatan_id" required>
                                    <option selected disabled value="">-- Pilih salah satu --</option>
                                    <option value="1">Tugas Sekolah/Tugas Kuliah</option>
                                    <option value="2">Pemerintah</option>
                                    <option value="3">Komersial</option>
                                    <option value="4">Penelitian</option>
                                    <option value="5">Lainnya</option>
                                </select>
                                <div class="lainnya-input-wrapper" id="pemanfaatan_lainnya_wrapper">
                                    <input type="text" class="form-control form-control-sm" name="pemanfaatan_lainnya" placeholder="Sebutkan lainnya...">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block fw-bold">10. Jenis Layanan yang Digunakan (Bisa pilih lebih dari 1)</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Perpustakaan" id="jenis_perpustakaan">
                                    <label class="form-check-label" for="jenis_perpustakaan">Perpustakaan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Pembelian Publikasi" id="layanan_pembelian_publikasi">
                                    <label class="form-check-label" for="layanan_pembelian_publikasi">Pembelian Produk Statistik Berbayar: Publikasi BPS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Pembelian Data Mikro" id="jenis_datamikro">
                                    <label class="form-check-label" for="jenis_datamikro">Pembelian Produk Statistik Berbayar: Data Mikro/Peta Wilayah Kerja Statistik</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Akses Website" id="jenis_website">
                                    <label class="form-check-label" for="jenis_website">Akses Produk Statistik Pada Website BPS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Konsultasi Statistik" id="jenis_konsultasi">
                                    <label class="form-check-label" for="jenis_konsultasi">Konsultasi Statistik</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Rekomendasi Kegiatan" id="jenis_rekomendasi">
                                    <label class="form-check-label" for="jenis_rekomendasi">Rekomendasi Kegiatan Statistik</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block fw-bold">11. Sarana yang digunakan untuk memperoleh Layanan BPS (Bisa pilih lebih dari 1)</label>
                                <div class="form-check">
                                    <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="PST Datang Langsung" id="sarana_pst_langsung">
                                    <label class="form-check-label" for="sarana_pst_langsung">Pelayanan Statistik Terpadu (PST) datang langsung</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="PST Online" id="sarana_pst_online">
                                    <label class="form-check-label" for="sarana_pst_online">Pelayanan Statistik Terpadu online (pst.bps.go.id)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="Website BPS" id="sarana_website">
                                    <label class="form-check-label" for="sarana_website">Website BPS (bps.go.id) / AllStats BPS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="Surat/Email" id="sarana_email">
                                    <label class="form-check-label" for="sarana_email">Surat / Email</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="Aplikasi Chat" id="sarana_chat">
                                    <label class="form-check-label" for="sarana_chat">Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="Lainnya" id="sarana_lainnya_checkbox">
                                    <label class="form-check-label" for="sarana_lainnya_checkbox">Lainnya</label>
                                </div>
                                <div class="lainnya-input-wrapper" id="sarana_lainnya_wrapper">
                                    <input type="text" class="form-control form-control-sm" name="sarana_lainnya" placeholder="Sebutkan sarana lainnya...">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block fw-bold">12. Apakah pernah melakukan pengaduan terkait Pelayanan Statistik Terpadu (PST)?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pernah_pengaduan" id="pengaduan_ya" value="Ya" required>
                                    <label class="form-check-label" for="pengaduan_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pernah_pengaduan" id="pengaduan_tidak" value="Tidak" required>
                                    <label class="form-check-label" for="pengaduan_tidak">Tidak</label>
                                </div>
                            </div>

                            {{-- Tambahkan pertanyaan Blok I lainnya di sini --}}

                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-primary" onclick="nextBlock(2)">Selanjutnya &raquo;</button>
                            </div>
                        </div>

                        <!-- {{-- ================================================================== --}}
                        {{-- =                               BLOK II                          = --}}
                        {{-- ================================================================== --}} -->
                        <div id="block-2" class="survey-block" style="display: none;">
                            <h5 class="mb-3">BLOK II. Kepuasan terhadap Layanan</h5>
                            <p class="text-muted small">Menurut pendapat Saudara, bagaimana tingkat kepentingan dan tingkat kepuasan Saudara pada rincian pelayanan berikut?</p>
                            <p class="text-muted small">Klik angka yang Saudara pilih sesuai skala berikut (1: Sangat Tidak Penting/Puas, 10: Sangat Penting/Puas).</p>
                            <p class="text-muted small">Tingkat kepentingan adalah gambaran pelayanan yang seharusnya diberikan BPS sesuai dengan keinginan/harapan konsumen.</p>
                            <p class="text-muted small">Tingkat kepuasan adalah penilaian kinerja yang dirasakan konsumen.</p>
                            <p class="text-muted small">1> Tidak wajib diisi jika tidak pernah melakukan pengaduan</p>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">1</span>. Informasi pelayanan pada unit layanan ini tersedia melalui media elektronik maupun non elektronik.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q1-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q1-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q1][kepentingan]" id="q1-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q1-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q1-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q1][kepuasan]" id="q1-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">2</span>. Persyaratan pelayanan yang ditetapkan mudah dipenuhi/disiapkan oleh konsumen.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q2-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q2-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q2][kepentingan]" id="q2-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q2-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q2-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q2][kepuasan]" id="q2-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">3</span>. Prosedur/alur pelayanan yang ditetapkan mudah diikuti/dilakukan.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q3-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q3-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q3][kepentingan]" id="q3-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q3-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q3-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q3][kepuasan]" id="q3-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">4</span>. Jangka waktu penyelesaian pelayanan yang diterima sesuai dengan yang ditetapkan.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q4-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q4-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q4][kepentingan]" id="q4-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q4-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q4-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q4][kepuasan]" id="q4-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">5</span>. Biaya pelayanan yang dibayarkan sesuai dengan biaya yang ditetapkan.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q5-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q5-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q5][kepentingan]" id="q5-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q5-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q5-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q5][kepuasan]" id="q5-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">6</span>. Produk pelayanan yang diterima sesuai dengan yang dijanjikan.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q6-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q6-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q6][kepentingan]" id="q6-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q6-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q6-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q6][kepuasan]" id="q6-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">7</span>. Sarana dan prasarana pendukung pelayanan memberikan kenyamanan.</label>
                                <label class="form-label">Sarana prasarana meliputi ruang khusus pelayanan, ruang tunggu, tempat parkir, toilet khusus pengguna layanan,sarana bagi yang berkebutuhan khusus, dan aplikasi pelayanan online.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q7-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q7-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q7][kepentingan]" id="q7-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q7-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q7-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q7][kepuasan]" id="q7-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">8</span>. Data BPS mudah diakses melalui fasilitas utama yang digunakan.</label>
                                <select class="form-select mb-3" id="fasilitas-utama-dropdown" name="penilaian[q8][fasilitas_utama]" required>
                                    {{-- Opsi akan diisi oleh JavaScript --}}
                                </select>
                                {{-- Skala Tingkat Kepentingan --}}
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q8-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q8-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q8][kepentingan]" id="q8-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                {{-- Skala Tingkat Kepuasan --}}
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q8-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q8-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q8][kepuasan]" id="q8-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">9</span>. Petugas pelayanan dan/atau aplikasi pelayanan online merespon dengan baik.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q9-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q9-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q9][kepentingan]" id="q9-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q9-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q9-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q9][kepuasan]" id="q9-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">10</span>. Petugas pelayanan dan/atau aplikasi pelayanan online mampu memberikan informasi yang jelas.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q10-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q10-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q10][kepentingan]" id="q10-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q10-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q10-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q10][kepuasan]" id="q10-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">11</span>. Keberadaan fasilitas pengaduan PST mudah diketahui. (contoh: Kotak saran dan pengaduan, website https://webapps.bps.go.id/pengaduan, e-mail bpshq@bps.go.id)</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q11-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q11-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q11][kepentingan]" id="q11-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q11-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q11-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q11][kepuasan]" id="q11-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div id="pertanyaan-12-wrapper" class="survey-question-blok2" style="display: none;">
                                <div class="mb-4 p-3 border rounded">
                                    <label class="form-label fw-bold"><span class="question-number">12</span>. Proses penanganan pengaduan PST mudah diketahui, jelas, dan tidak berbelit-belit.</label>
                                    {{-- Skala Kepentingan --}}
                                    <div class="mb-3">
                                        <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item" for="q12-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q12][kepentingan]" id="q12-kepentingan-{{ $i }}" value="{{ $i }}">
                                                @endfor
                                        </div>
                                    </div>
                                    {{-- Skala Kepuasan --}}
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item" for="q12-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q12][kepuasan]" id="q12-kepuasan-{{ $i }}" value="{{ $i }}">
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">13</span>. Tidak ada diskriminasi dalam pelayanan.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q13-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q13-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q13][kepentingan]" id="q13-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q13-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q13-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q13][kepuasan]" id="q13-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">14</span>. Tidak ada pelayanan di luar prosedur/kecurangan pelayanan.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q14-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q14-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q14][kepentingan]" id="q14-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q14-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q14-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q14][kepuasan]" id="q14-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">15</span>. Tidak ada penerimaan gratifikasi.</label>
                                <label class="form-label">PP nomor 13 tahun 2024 tentang PNBP dan link PerBan No-2-Tahun-2019 ttg tarif nol rupiah</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q15-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q15-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q15][kepentingan]" id="q15-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q15-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q15-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q15][kepuasan]" id="q15-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">16</span>. Tidak ada pungutan liar (pungli) dalam pelayanan</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q16-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q16-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q16][kepentingan]" id="q16-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q16-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q16-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q16][kepuasan]" id="q16-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded survey-question-blok2">
                                <label class="form-label fw-bold"><span class="question-number">17</span>. Tidak ada praktik percaloan dalam pelayanan.</label>
                                <div class="mb-3">
                                    <span class="badge bg-secondary rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                    <div class="scale-container" id="scale-q17-kepentingan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q17-kepentingan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q17][kepentingan]" id="q17-kepentingan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                    <div class="scale-container" id="scale-q17-kepuasan">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <label class="scale-item" for="q17-kepuasan-{{ $i }}">{{ $i }}</label>
                                            <input type="radio" class="d-none" name="penilaian[q17][kepuasan]" id="q17-kepuasan-{{ $i }}" value="{{ $i }}" required>
                                            @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary" onclick="prevBlock(1)">&laquo; Kembali</button>
                                <button type="button" class="btn btn-primary" onclick="nextBlock(3)">Selanjutnya &raquo;</button>
                            </div>
                        </div>

                        <!-- {{-- ================================================================== --}}
                        {{-- =                           BLOK III                             = --}}
                        {{-- ================================================================== --}} -->
                        <div id="block-3" class="survey-block" style="display: none;">
                            <h5 class="mb-3">BLOK III. Kebutuhan Data</h5>
                            <p class="text-muted">Isikan data-data yang dibutuhkan/dikonsultasikan dari BPS dengan mengklik tombol di bawah ini.</p>

                            <button type="button" class="btn btn-success mb-3" id="openModalForAddBtn">
                                + Tambah Kebutuhan Data
                            </button>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Rincian Data</th>
                                            <th>Wilayah Data</th>
                                            <th>Tahun Data</th>
                                            <th>Level Data</th>
                                            <th>Periode Data</th>
                                            <th>Data Diperoleh</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kebutuhanDataTableBody">
                                        <tr id="kebutuhan-data-placeholder">
                                            <td colspan="8" class="text-center text-muted">Belum ada data yang ditambahkan.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary" onclick="prevBlock(2)">&laquo; Kembali</button>
                                <button type="button" class="btn btn-primary" onclick="nextBlock(4)">Selanjutnya &raquo;</button>
                            </div>
                        </div>


                        <!-- {{-- ================================================================== --}}
                        {{-- =                                BLOK IV                               = --}}
                        {{-- ================================================================== --}} -->
                        <div id="block-4" class="survey-block" style="display: none;">
                            <h5 class="mb-3">BLOK IV. Catatan</h5>

                            <div class="mb-3">
                                <label for="catatan" class="form-label">Tuliskan kritik dan saran terhadap produk dan layanan data/informasi statistik yang disediakan oleh BPS.</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="5"></textarea>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary" onclick="prevBlock(3)">&laquo; Kembali</button>
                                <button type="submit" class="btn btn-success">Kirim Survei</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Tambah/Edit Form Kebutuhan Data -->
<div class="modal fade" id="kebutuhanDataModal" tabindex="-1" aria-labelledby="kebutuhanDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kebutuhanDataModalLabel">Form Kebutuhan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalKebutuhanForm">
                    <div class="mb-3">
                        <label class="form-label">1. Rincian Data</label>
                        <input type="text" class="form-control" id="rincian_data" placeholder="Contoh: Indeks Pembangunan Manusia">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">2. Wilayah Jenis Data</label>
                            <input type="text" class="form-control" id="wilayah_data">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">3. Tahun Jenis Data</label>
                            <input type="text" class="form-control" id="tahun_data" placeholder="Contoh: 2022 atau 2020-2022">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">4. Level Data</label>
                        <select class="form-select" id="level_data">
                            <option value="" selected disabled>-- Pilih salah satu --</option>
                            <option value="nasional">Nasional</option>
                            <option value="provinsi">Provinsi</option>
                            <option value="kabupaten/kota">Kabupaten/Kota</option>
                            <option value="kecamatan">Kecamatan</option>
                            <option value="desa/kelurahan">Desa/Kelurahan</option>
                            <option value="individu">Individu</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3" id="level_data_lainnya_wrapper" style="display: none;">
                        <label class="form-label">Sebutkan Level Lainnya</label>
                        <input type="text" class="form-control" id="level_data_lainnya">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">5. Periode Data</label>
                        <select class="form-select" id="periode_data">
                            <option value="" selected disabled>-- Pilih salah satu --</option>
                            <option value="sepuluh tahunan">Sepuluh Tahunan</option>
                            <option value="lima tahunan">Lima Tahunan</option>
                            <option value="tahunan">Tahunan</option>
                            <option value="semesteran">Semesteran</option>
                            <option value="triwulanan">Triwulanan</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3" id="periode_data_lainnya_wrapper" style="display: none;">
                        <label class="form-label">Sebutkan Periode Lainnya</label>
                        <input type="text" class="form-control" id="periode_data_lainnya">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">6. Apakah data pada nomor (1) - (5) sudah diperoleh?</label>
                        <select class="form-select" id="data_diperoleh">
                            <option value="" selected disabled>-- Pilih salah satu --</option>
                            <option value="belum diperoleh">Belum Diperoleh</option>
                            <option value="tidak diperoleh">Tidak Diperoleh</option>
                            <option value="ya sesuai">Ya, Sesuai</option>
                            <option value="ya belum sesuai">Ya, Belum Sesuai</option>
                        </select>
                    </div>

                    <div id="pertanyaanTambahanWrapper" style="display: none;">
                        <hr>
                        <div class="mb-3">
                            <label for="jenis_publikasi" class="form-label"><span class="modal-question-number">7.</span> Jenis Sumber Data</label>
                            <select class="form-select" id="jenis_publikasi">
                                <option value="" selected disabled>-- Pilih Jenis Sumber --</option>
                                <option value="Publikasi">Publikasi</option>
                                <option value="Data Mikro">Data Mikro</option>
                                <option value="Peta Wilkerstat">Peta Wilkerstat</option>
                                <option value="Tabulasi Data">Tabulasi Data</option>
                                <option value="Tabel di Website">Tabel di Website</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="judul_publikasi" class="form-label"><span class="modal-question-number">8.</span> Judul Publikasi/Sumber Data</label>
                            <input type="text" class="form-control" id="judul_publikasi">
                        </div>
                        <div class="mb-3">
                            <label for="tahun_publikasi" class="form-label"><span class="modal-question-number">9.</span> Tahun Publikasi</label>
                            <input type="number" class="form-control" id="tahun_publikasi" min="1900" max="2100">
                        </div>
                        <div class="mb-3" id="perencanaan_wrapper">
                            <label class="form-label d-block"><span class="modal-question-number">10.</span> Apakah data ini digunakan untuk perencanaan, monitoring, dan evaluasi pembangunan nasional?</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="digunakan_perencanaan" id="perencanaan_ya" value="Ya">
                                <label class="form-check-label" for="perencanaan_ya">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="digunakan_perencanaan" id="perencanaan_tidak" value="Tidak">
                                <label class="form-check-label" for="perencanaan_tidak">Tidak</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><span class="modal-question-number">11.</span> Kualitas (dalam penilaian 1-10)</label>
                            <div class="scale-container" id="modal-scale-kualitas">
                                @for ($i = 1; $i <= 10; $i++)
                                    <label class="scale-item" for="kualitas-{{ $i }}">{{ $i }}</label>
                                    <input type="radio" class="d-none" name="kualitas_data" id="kualitas-{{ $i }}" value="{{ $i }}">
                                    @endfor
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanKebutuhanData">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript untuk membuat formulir multi-step dan mengaktifkan skala --}}
<script>
    let currentBlock = 1;
    const totalBlocks = 4;
    const progressBar = document.getElementById('progressBar');
    const blockTitles = ["BLOK I", "BLOK II", "BLOK III", "BLOK IV"];

    function showBlock(blockNumber) {
        document.querySelectorAll('.survey-block').forEach(block => {
            block.style.display = 'none';
        });
        document.getElementById('block-' + blockNumber).style.display = 'block';
        const progress = (blockNumber / totalBlocks) * 100;
        progressBar.style.width = progress + '%';
        progressBar.textContent = blockTitles[blockNumber - 1];
    }

    function updateFasilitasDropdown() {
        const dropdown = document.getElementById('fasilitas-utama-dropdown');
        const checkedSaranas = document.querySelectorAll('.sarana-checkbox:checked');
        dropdown.innerHTML = '<option value="" selected disabled>-- Pilih salah satu fasilitas utama --</option>';
        checkedSaranas.forEach(checkbox => {
            const option = document.createElement('option');
            option.value = checkbox.value;
            option.textContent = document.querySelector(`label[for='${checkbox.id}']`).textContent.trim();
            dropdown.add(option);
        });
    }

    // [PERUBAHAN] Fungsi untuk menampilkan/menyembunyikan dan menomori ulang pertanyaan
    function handlePengaduanQuestion() {
        const wrapper = document.getElementById('pertanyaan-12-wrapper');
        const radioYa = document.getElementById('pengaduan_ya');
        const radioYaChecked = radioYa.checked;
        wrapper.style.display = radioYaChecked ? 'block' : 'none';
        wrapper.querySelectorAll('input[type="radio"]').forEach(input => {
            input.required = radioYaChecked;
        });
        let questionCounter = 1;
        document.querySelectorAll('#block-2 .survey-question-blok2').forEach(questionDiv => {
            if (questionDiv.style.display !== 'none') {
                const numberSpan = questionDiv.querySelector('.question-number');
                if (numberSpan) {
                    numberSpan.textContent = questionCounter;
                    questionCounter++;
                }
            }
        });
    }

    function nextBlock(blockNumber) {
        if (blockNumber === 2) {
            updateFasilitasDropdown();
            handlePengaduanQuestion();
        }
        currentBlock = blockNumber;
        showBlock(currentBlock);
    }

    function prevBlock(blockNumber) {
        currentBlock = blockNumber;
        showBlock(currentBlock);
    }

    document.addEventListener('DOMContentLoaded', function() {
        showBlock(currentBlock);

        document.querySelectorAll('input[name="pernah_pengaduan"]').forEach(radio => {
            radio.addEventListener('change', handlePengaduanQuestion);
        });

        document.querySelectorAll('.scale-item').forEach(item => {
            item.addEventListener('click', function() {
                const parentContainer = this.closest('.scale-container');
                parentContainer.querySelectorAll('.scale-item').forEach(sibling => {
                    sibling.classList.remove('scale-selected');
                });
                this.classList.add('scale-selected');
            });
        });

        function handleLainnyaDropdown(selectId, wrapperId, lainnyaValue) {
            const selectElement = document.getElementById(selectId);
            const wrapperElement = document.getElementById(wrapperId);
            const inputElement = wrapperElement.querySelector('input');
            if (!selectElement) return;
            selectElement.addEventListener('change', function() {
                if (this.value === lainnyaValue) {
                    wrapperElement.style.display = 'block';
                    inputElement.required = true;
                } else {
                    wrapperElement.style.display = 'none';
                    inputElement.value = '';
                    inputElement.required = false;
                }
            });
        }

        handleLainnyaDropdown('pekerjaan_id', 'pekerjaan_lainnya_wrapper', '7');
        handleLainnyaDropdown('instansi_id', 'instansi_lainnya_wrapper', '9');
        handleLainnyaDropdown('pemanfaatan_id', 'pemanfaatan_lainnya_wrapper', '5');

        const saranaLainnyaCheckbox = document.getElementById('sarana_lainnya_checkbox');
        const saranaLainnyaWrapper = document.getElementById('sarana_lainnya_wrapper');
        const saranaLainnyaInput = saranaLainnyaWrapper.querySelector('input');

        saranaLainnyaCheckbox.addEventListener('change', function() {
            if (this.checked) {
                saranaLainnyaWrapper.style.display = 'block';
                saranaLainnyaInput.required = true;
            } else {
                saranaLainnyaWrapper.style.display = 'none';
                saranaLainnyaInput.value = '';
                saranaLainnyaInput.required = false;
            }
        });

        // --- LOGIKA BLOK III ---
        // --- LOGIKA BARU UNTUK BLOK III (ADD, VIEW, EDIT, DELETE) ---

        // --- LOGIKA BARU UNTUK BLOK III (DENGAN PENANGANAN "LAINNYA") ---

        // --- LOGIKA BARU UNTUK BLOK III (DENGAN PENANGANAN "LAINNYA" UNTUK LEVEL & PERIODE) ---

        // --- LOGIKA BARU UNTUK BLOK III (DENGAN KONDISI & PENOMORAN OTOMATIS) ---

        let kebutuhanDataArray = [];
        let modalMode = 'add';
        let currentDataId = null;

        // Ambil semua elemen yang dibutuhkan
        const modalElement = document.getElementById('kebutuhanDataModal');
        const modal = new bootstrap.Modal(modalElement);
        const modalForm = document.getElementById('modalKebutuhanForm');
        const modalTitle = document.getElementById('kebutuhanDataModalLabel');
        const simpanBtn = document.getElementById('simpanKebutuhanData');
        const tableBody = document.getElementById('kebutuhanDataTableBody');
        const placeholderRow = document.getElementById('kebutuhan-data-placeholder');
        const hiddenJsonInput = document.getElementById('kebutuhan_data_json');
        const openModalBtn = document.getElementById('openModalForAddBtn');

        // Elemen form spesifik
        const dataDiperolehSelect = document.getElementById('data_diperoleh');
        const pertanyaanTambahanWrapper = document.getElementById('pertanyaanTambahanWrapper');
        const levelDataSelect = document.getElementById('level_data');
        const levelDataLainnyaWrapper = document.getElementById('level_data_lainnya_wrapper');
        const periodeDataSelect = document.getElementById('periode_data');
        const periodeDataLainnyaWrapper = document.getElementById('periode_data_lainnya_wrapper');
        const perencanaanWrapper = document.getElementById('perencanaan_wrapper');

        // --- HELPER FUNCTIONS ---

        function renumberModalQuestions() {
            let questionCounter = 7;
            document.querySelectorAll('#pertanyaanTambahanWrapper .mb-3').forEach(questionDiv => {
                if (questionDiv.style.display !== 'none' && questionDiv.querySelector('.modal-question-number')) {
                    const numberSpan = questionDiv.querySelector('.modal-question-number');
                    // Ganti label pada elemen span-nya saja
                    numberSpan.textContent = `${questionCounter}.`;
                    questionCounter++;
                }
            });
        }

        function handlePerencanaanVisibility() {
            const instansiValue = document.getElementById('instansi_id').value;
            const triggerValues = ['1', '2', '3', '4'];

            if (triggerValues.includes(instansiValue)) {
                perencanaanWrapper.style.display = 'block';
            } else {
                perencanaanWrapper.style.display = 'none';
                document.querySelectorAll('input[name="digunakan_perencanaan"]').forEach(radio => radio.checked = false);
            }
            renumberModalQuestions();
        }

        function populateModalForm(data) {
            modalForm.reset();
            document.getElementById('rincian_data').value = data.rincian_data || '';
            document.getElementById('wilayah_data').value = data.wilayah_data || '';
            document.getElementById('tahun_data').value = data.tahun_data || '';

            levelDataSelect.value = data.level_data || '';
            levelDataSelect.dispatchEvent(new Event('change'));
            if (data.level_data === 'lainnya') {
                document.getElementById('level_data_lainnya').value = data.level_data_lainnya || '';
            }

            periodeDataSelect.value = data.periode_data || '';
            periodeDataSelect.dispatchEvent(new Event('change'));
            if (data.periode_data === 'lainnya') {
                document.getElementById('periode_data_lainnya').value = data.periode_data_lainnya || '';
            }

            dataDiperolehSelect.value = data.data_diperoleh || '';
            dataDiperolehSelect.dispatchEvent(new Event('change'));

            if (data.data_diperoleh === 'ya sesuai' || data.data_diperoleh === 'ya belum sesuai') {
                document.getElementById('jenis_publikasi').value = data.jenis_publikasi || '';
                document.getElementById('judul_publikasi').value = data.judul_publikasi || '';
                document.getElementById('tahun_publikasi').value = data.tahun_publikasi || '';
                if (data.digunakan_perencanaan) {
                    document.querySelector(`input[name="digunakan_perencanaan"][value="${data.digunakan_perencanaan}"]`).checked = true;
                }
                if (data.kualitas_data) {
                    const kualitasInput = document.querySelector(`input[name="kualitas_data"][value="${data.kualitas_data}"]`);
                    if (kualitasInput) {
                        kualitasInput.checked = true;
                        kualitasInput.closest('.scale-container').querySelectorAll('.scale-item').forEach(el => el.classList.remove('scale-selected'));
                        kualitasInput.previousElementSibling.classList.add('scale-selected');
                    }
                }
            }
        }

        function toggleModalFields(disabled) {
            Array.from(modalForm.elements).forEach(element => {
                element.disabled = disabled;
            });
        }

        // --- MODAL & TABLE LOGIC ---

        function renderKebutuhanDataTable() {
            tableBody.innerHTML = '';
            if (kebutuhanDataArray.length === 0) {
                tableBody.appendChild(placeholderRow);
                placeholderRow.style.display = 'table-row';
            } else {
                placeholderRow.style.display = 'none';
                kebutuhanDataArray.forEach((data, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${index + 1}</td>
                <td>${data.rincian_data || '-'}</td>
                <td>${data.wilayah_data || '-'}</td>
                <td>${data.tahun_data || '-'}</td>
                <td>${data.level_data === 'lainnya' ? data.level_data_lainnya : data.level_data || '-'}</td>
                <td>${data.periode_data === 'lainnya' ? data.periode_data_lainnya : data.periode_data || '-'}</td>
                <td>${data.data_diperoleh || '-'}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" onclick="viewKebutuhanData(${data.id})">Lihat</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="editKebutuhanData(${data.id})">Ubah</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusKebutuhanData(${data.id})">Hapus</button>
                </td>
            `;
                    tableBody.appendChild(row);
                });
            }
            hiddenJsonInput.value = JSON.stringify(kebutuhanDataArray);
        }

        // --- EVENT HANDLERS ---

        openModalBtn.addEventListener('click', function() {
            modalMode = 'add';
            currentDataId = null;
            modalTitle.textContent = 'Tambah Kebutuhan Data';
            modalForm.reset();
            toggleModalFields(false);
            simpanBtn.style.display = 'block';

            // Panggil fungsi visibility & renumber setiap modal dibuka
            handlePerencanaanVisibility();
            modal.show();
        });

        window.viewKebutuhanData = function(id) {
            const data = kebutuhanDataArray.find(d => d.id === id);
            if (!data) return;

            modalMode = 'view';
            currentDataId = id;
            modalTitle.textContent = 'Lihat Detail Data';
            populateModalForm(data);
            toggleModalFields(true);
            simpanBtn.style.display = 'none';

            handlePerencanaanVisibility();
            modal.show();
        };

        window.editKebutuhanData = function(id) {
            const data = kebutuhanDataArray.find(d => d.id === id);
            if (!data) return;

            modalMode = 'edit';
            currentDataId = id;
            modalTitle.textContent = 'Ubah Kebutuhan Data';
            populateModalForm(data);
            toggleModalFields(false);
            simpanBtn.style.display = 'block';

            handlePerencanaanVisibility();
            modal.show();
        };

        window.hapusKebutuhanData = function(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                kebutuhanDataArray = kebutuhanDataArray.filter(data => data.id !== id);
                renderKebutuhanDataTable();
            }
        };

        // GANTI SELURUH FUNGSI INI DENGAN YANG BARU
        simpanBtn.addEventListener('click', function() {
            const isTambahanVisible = pertanyaanTambahanWrapper.style.display === 'block';
            const isPerencanaanVisible = perencanaanWrapper.style.display === 'block';

            const formData = {
                rincian_data: document.getElementById('rincian_data').value,
                wilayah_data: document.getElementById('wilayah_data').value,
                tahun_data: document.getElementById('tahun_data').value,
                level_data: levelDataSelect.value,
                level_data_lainnya: document.getElementById('level_data_lainnya').value,
                periode_data: periodeDataSelect.value,
                periode_data_lainnya: document.getElementById('periode_data_lainnya').value,
                data_diperoleh: dataDiperolehSelect.value,

                // --- BAGIAN YANG DIPERBAIKI ADA DI SINI ---
                // Data rincian 7-11 hanya akan diambil JIKA bagiannya terlihat
                jenis_publikasi: isTambahanVisible ? document.getElementById('jenis_publikasi').value : null,
                judul_publikasi: isTambahanVisible ? document.getElementById('judul_publikasi').value : null,
                tahun_publikasi: isTambahanVisible ? document.getElementById('tahun_publikasi').value : null,
                digunakan_perencanaan: isTambahanVisible && isPerencanaanVisible ? (document.querySelector('input[name="digunakan_perencanaan"]:checked')?.value || null) : null,
                kualitas_data: isTambahanVisible ? (document.querySelector('input[name="kualitas_data"]:checked')?.value || null) : null,
            };

            // Validasi dasar
            if (!formData.rincian_data) {
                alert('Rincian Data wajib diisi.');
                return;
            }
            if (formData.level_data === 'lainnya' && !formData.level_data_lainnya) {
                alert('Harap sebutkan level data lainnya.');
                return;
            }
            if (formData.periode_data === 'lainnya' && !formData.periode_data_lainnya) {
                alert('Harap sebutkan periode data lainnya.');
                return;
            }

            // Simpan data ke array
            if (modalMode === 'add') {
                formData.id = Date.now();
                kebutuhanDataArray.push(formData);
            } else if (modalMode === 'edit') {
                const index = kebutuhanDataArray.findIndex(d => d.id === currentDataId);
                if (index !== -1) {
                    // Gabungkan data lama dengan data baru, agar nilai null tidak menimpa data yang ada
                    kebutuhanDataArray[index] = {
                        ...kebutuhanDataArray[index],
                        ...formData
                    };
                }
            }

            renderKebutuhanDataTable();
            modal.hide();
        });

        // Event listener untuk dropdown
        levelDataSelect.addEventListener('change', function() {
            levelDataLainnyaWrapper.style.display = (this.value === 'lainnya') ? 'block' : 'none';
        });
        periodeDataSelect.addEventListener('change', function() {
            periodeDataLainnyaWrapper.style.display = (this.value === 'lainnya') ? 'block' : 'none';
        });
        dataDiperolehSelect.addEventListener('change', function() {
            const show = (this.value === 'ya sesuai' || this.value === 'ya belum sesuai');
            pertanyaanTambahanWrapper.style.display = show ? 'block' : 'none';
            if (show) {
                handlePerencanaanVisibility(); // Cek ulang visibility saat wrapper utama muncul
            }
        });

        // Reset modal setelah ditutup
        modalElement.addEventListener('hidden.bs.modal', function() {
            modalForm.reset();
            pertanyaanTambahanWrapper.style.display = 'none';
            levelDataLainnyaWrapper.style.display = 'none';
            periodeDataLainnyaWrapper.style.display = 'none';
            perencanaanWrapper.style.display = 'none';
            document.querySelectorAll('#modal-scale-kualitas .scale-item').forEach(el => el.classList.remove('scale-selected'));
        });

        // Panggil render pertama kali
        renderKebutuhanDataTable();

    });
</script>

{{-- LETAKKAN BLOK INI DI BAGIAN BAWAH, SEBELUM @endsection --}}

{{-- LETAKKAN BLOK INI DI BAGIAN BAWAH, SEBELUM @endsection --}}

<script>
    // Skrip ini untuk mencegah browser menampilkan form yang sudah terisi dari cache
    // saat pengguna menekan tombol Back.
    const navigationEntries = performance.getEntriesByType("navigation");
    if (navigationEntries.length > 0 && navigationEntries[0].type === "back_forward") {
        // Jika halaman ini dibuka via tombol Back/Forward, paksa reload dari server.
        window.location.reload();
    }
</script>
@endsection