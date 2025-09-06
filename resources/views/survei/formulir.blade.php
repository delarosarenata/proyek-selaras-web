@extends('layouts.app-no-header')

@section('title', 'Formulir Survei Penilaian Pelayanan')

@section('content')

@php
    $penilaian = old('penilaian', $respondent->penilaian ?? []);
    // BENAR: pakai kebutuhan_data (kolom DB) + encode ke JSON
    $existingKebutuhanJson = old(
        'kebutuhan_data_json',
        json_encode($respondent->kebutuhan_data ?? [])
    );
    $oldFasilitas = $penilaian['q8']['fasilitas_utama'] ?? '';
@endphp



<style>
    /* --- Google Font (Opsional, tapi memberikan sentuhan modern) --- */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    /* --- Variabel Warna & Style Global (EYE-FRIENDLY) --- */
    :root {
        --primary-color: #C1856D;
        /* Biru yang lebih lembut */
        --bg-page: #E6CFA9;
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

    /* --- Style untuk Validasi Error --- */
    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545 !important;
        /* Warna merah Bootstrap */
        background-image: none;
        /* Hapus ikon validasi default */
    }

    /* Style untuk pesan error di bawah input */
    .invalid-feedback {
        display: none;
        /* Sembunyi secara default */
        width: 100%;
        margin-top: 0.25rem;
        font-size: .875em;
        color: #dc3545;
    }

    /* Tampilkan pesan error saat input memiliki kelas .is-invalid */
    .is-invalid~.invalid-feedback {
        display: block;
    }

    /* Style untuk grup radio/checkbox yang tidak valid */
    [data-required-radio].is-invalid .form-check-label,
    [data-required-checkbox].is-invalid .form-check-label {
        color: #dc3545;
    }

    .penilaian{
        background: #9A3F3F;
    }
</style>

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header text-center penilaian text-white">
                    <h4>PENILAIAN PELAYANAN DAN RESPON STATISTIK</h4>
                    <h4>BPS KABUPATEN PINRANG</h4>
                </div>
                <div class="card-body p-4">
                    <div class="progress mb-4" style="height: 25px;">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">BLOK I</div>
                    </div>

                    @if(isset($respondent))
                    {{-- Jika ini adalah mode EDIT, form akan menunjuk ke route UPDATE --}}
                    <form action="{{ route('kuesioner.update', $respondent) }}" method="POST" id="surveyForm" novalidate>
                        @csrf
                        @method('PUT') {{-- Perintah penting untuk memberi tahu Laravel ini adalah UPDATE --}}
                        @else
                        {{-- Jika ini adalah mode BUAT BARU, form akan menunjuk ke route STORE --}}
                        <form action="{{ route('kuesioner.store') }}" method="POST" id="surveyForm" novalidate>
                            @csrf
                            @endif

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

                            <!-- <input type="hidden" name="kebutuhan_data_json" id="kebutuhan_data_json"> -->
                            <input type="hidden" name="kebutuhan_data_json" id="kebutuhan_data_json" value='{!! $existingKebutuhanJson !!}'>
                            
                            <div id="block-0" class="survey-block">
                                <div class="card mb-4">
                                    <div class="card-header"><h5 class="mb-0">Bagian A: Penilaian Petugas</h5></div>
                                    <div class="card-body">
                                        
                                        {{-- ====================================================== --}}
                                        {{--                BAGIAN PILIHAN PETUGAS                  --}}
                                        {{-- ====================================================== --}}
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Siapakah petugas yang melayani Anda?</label>
                                            
                                            <div data-required-radio="petugas_id"> 
                                                <div class="row g-3">
                                                    @foreach ($petugas as $p)
                                                    <div class="col-6 col-md-3">
                                                        <div class="text-center">
                                                            <label for="petugas_{{ $p->id }}">
                                                                <img src="{{ asset('storage/' . $p->path_foto) }}" alt="{{ $p->nama }}" class="img-fluid" style="object-fit: cover;">
                                                                <p class="mb-1 fw-bold">{{ $p->nama }}</p>
                                                            </label>
                                                            <input type="radio" class="form-check-input" name="petugas_id" id="petugas_{{ $p->id }}" value="{{ $p->id }}"
                                                                {{-- Logika untuk 'checked' saat mode edit --}}
                                                                @if(old('petugas_id', $respondent->petugas_id ?? null) == $p->id) checked @endif
                                                            >
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <div class="d-flex flex-wrap gap-3">
                                                            <div class="form-check">
                                                                @php
                                                                    // Cek apakah 'lainnya' yang harus dipilih saat mode edit
                                                                    $isLainnya = old('petugas_id') === 'lainnya' || (isset($respondent) && $respondent->petugas_lainnya_nama && is_null($respondent->petugas_id));
                                                                @endphp
                                                                <input class="form-check-input" type="radio" name="petugas_id" id="petugas_lainnya" value="lainnya" @if($isLainnya) checked @endif>
                                                                <label class="form-check-label fw-bold" for="petugas_lainnya">Petugas Lainnya</label>
                                                            </div>
                                                            <div class="form-check">
                                                                @php
                                                                    // Cek apakah 'tidak ingat' yang harus dipilih saat mode edit
                                                                    $isTidakIngat = old('petugas_id') === '' || (isset($respondent) && is_null($respondent->petugas_id) && is_null($respondent->petugas_lainnya_nama));
                                                                @endphp
                                                                <input class="form-check-input" type="radio" name="petugas_id" id="petugas_tidak_ingat" value="" @if($isTidakIngat) checked @endif>
                                                                <label class="form-check-label fw-bold" for="petugas_tidak_ingat">Saya tidak mengingat/mengetahuinya</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- Tampilkan kontainer 'lainnya' jika kondisinya terpenuhi saat mode edit --}}
                                                    <div class="col-12 mt-3" id="lainnya_container" style="{{ $isLainnya ? 'display: block;' : 'display: none;' }}">
                                                        <label for="petugas_lainnya_nama" class="form-label">Sebutkan nama petugas yang Anda ingat:</label>
                                                        <input type="text" class="form-control" name="petugas_lainnya_nama" id="petugas_lainnya_nama" placeholder="Ketik nama petugas..." 
                                                            value="{{ old('petugas_lainnya_nama', $respondent->petugas_lainnya_nama ?? '') }}">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback d-block"></div> 
                                        </div>

                                        <hr>

                                        {{-- ====================================================== --}}
                                        {{--                  BAGIAN RATING BINTANG                 --}}
                                        {{-- ====================================================== --}}
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Berikan Penilaian Anda</label>
                                            <div class="star-rating" data-required-radio="rating">
                                                <input type="radio" id="5-stars" name="rating" value="5" @if(old('rating', $respondent->rating ?? null) == 5) checked @endif /><label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="4-stars" name="rating" value="4" @if(old('rating', $respondent->rating ?? null) == 4) checked @endif /><label for="4-stars" class="star">&#9733;</label>
                                                <input type="radio" id="3-stars" name="rating" value="3" @if(old('rating', $respondent->rating ?? null) == 3) checked @endif /><label for="3-stars" class="star">&#9733;</label>
                                                <input type="radio" id="2-stars" name="rating" value="2" @if(old('rating', $respondent->rating ?? null) == 2) checked @endif /><label for="2-stars" class="star">&#9733;</label>
                                                <input type="radio" id="1-star" name="rating" value="1" @if(old('rating', $respondent->rating ?? null) == 1) checked @endif /><label for="1-star" class="star">&#9733;</label>
                                            </div>
                                            <div class="invalid-feedback d-block"></div>
                                        </div>

                                        {{-- ====================================================== --}}
                                        {{--                  BAGIAN KRITIK & SARAN                 --}}
                                        {{-- ====================================================== --}}
                                        <div class="mb-3">
                                            <label for="kritik_saran" class="form-label fw-bold">Kritik & Saran (Opsional)</label>
                                            <textarea class="form-control" id="kritik_saran" name="kritik_saran" rows="3" placeholder="Tuliskan masukan Anda...">{{ old('kritik_saran', $respondent->kritik_saran ?? '') }}</textarea>
                                        </div>

                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary" onclick="goNext()">Selanjutnya &raquo;</button>
                                </div>
                            </div>

                            <!-- {{-- ================================================================== --}}
                            {{-- =                               BLOK I                           = --}}
                            {{-- ================================================================== --}} -->
                            <div id="block-1" class="survey-block" style="display: none;">
                                <h5 class="mb-3 text-center">BLOK I. KETERANGAN RESPONDEN</h5>

                                <!-- 1. NAMA -->
                                <div class="mb-3">
                                    <label for="nama" class="form-label fw-bold">1. Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $respondent->nama ?? '') }}" data-required="true" data-minlength="3">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">2. E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $respondent->email ?? '') }}" data-required="true" data-email="true">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="no_hp" class="form-label fw-bold">3. No. Handphone</label>
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $respondent->no_hp ?? '') }}" data-required="true" data-numeric="true" data-minlength="8">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3" data-required-radio="jenis_kelamin">
                                    <label class="form-label d-block fw-bold">4. Jenis Kelamin</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki" @if(old('jenis_kelamin', $respondent->jenis_kelamin ?? '') == 'Laki-laki') checked @endif>
                                        <label class="form-check-label" for="laki_laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" @if(old('jenis_kelamin', $respondent->jenis_kelamin ?? '') == 'Perempuan') checked @endif>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                    <div class="invalid-feedback d-block"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="pendidikan_id" class="form-label d-block fw-bold">5. Pendidikan Tertinggi</label>
                                    <select class="form-select" name="pendidikan_id" data-required="true">
                                        <option value="" @if(empty(old('pendidikan_id', $respondent->pendidikan_id ?? ''))) selected @endif disabled>-- Pilih salah satu --</option>
                                        <option value="1" @if(old('pendidikan_id', $respondent->pendidikan_id ?? '') == 1) selected @endif><= SLTA/Sederajat</option>
                                        <option value="2" @if(old('pendidikan_id', $respondent->pendidikan_id ?? '') == 2) selected @endif>D1/D2/D3</option>
                                        <option value="3" @if(old('pendidikan_id', $respondent->pendidikan_id ?? '') == 3) selected @endif>D4/S1</option>
                                        <option value="4" @if(old('pendidikan_id', $respondent->pendidikan_id ?? '') == 4) selected @endif>S2</option>
                                        <option value="5" @if(old('pendidikan_id', $respondent->pendidikan_id ?? '') == 5) selected @endif>S3</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="pekerjaan_id" class="form-label fw-bold">6. Pekerjaan Utama</label>
                                    <select class="form-select" name="pekerjaan_id" id="pekerjaan_id" data-required="true">
                                        <option value="" @if(empty(old('pekerjaan_id', $respondent->pekerjaan_id ?? ''))) selected @endif disabled>-- Pilih salah satu --</option>
                                        <option value="1" @if(old('pekerjaan_id', $respondent->pekerjaan_id ?? '') == 1) selected @endif>Pelajar/Mahasiswa</option>
                                        <option value="2" @if(old('pekerjaan_id', $respondent->pekerjaan_id ?? '') == 2) selected @endif>Peneliti/Dosen</option>
                                        <option value="3" @if(old('pekerjaan_id', $respondent->pekerjaan_id ?? '') == 3) selected @endif>ASN/TNI/POLRI</option>
                                        <option value="4" @if(old('pekerjaan_id', $respondent->pekerjaan_id ?? '') == 4) selected @endif>Pegawai BUMN/BUMD</option>
                                        <option value="5" @if(old('pekerjaan_id', $respondent->pekerjaan_id ?? '') == 5) selected @endif>Pegawai Swasta</option>
                                        <option value="6" @if(old('pekerjaan_id', $respondent->pekerjaan_id ?? '') == 6) selected @endif>Wiraswasta</option>
                                        <option value="7" @if(old('pekerjaan_id', $respondent->pekerjaan_id ?? '') == 7) selected @endif>Lainnya</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                    <div class="lainnya-input-wrapper" id="pekerjaan_lainnya_wrapper" style="{{ old('pekerjaan_id', $respondent->pekerjaan_id ?? '') == 7 ? 'display: block;' : '' }}">
                                        <input type="text" class="form-control form-control-sm mt-2" name="pekerjaan_lainnya" placeholder="Sebutkan lainnya..." value="{{ old('pekerjaan_lainnya', $respondent->pekerjaan_lainnya ?? '') }}" data-minlength="3">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="instansi_id" class="form-label fw-bold">7. Kategori Instansi</label>
                                    <select class="form-select" name="instansi_id" id="instansi_id" data-required="true">
                                        <option value="" @if(empty(old('instansi_id', $respondent->instansi_id ?? ''))) selected @endif disabled>-- Pilih salah satu --</option>
                                        <option value="1" @if(old('instansi_id', $respondent->instansi_id ?? '') == 1) selected @endif>Lembaga Negara</option>
                                        <option value="2" @if(old('instansi_id', $respondent->instansi_id ?? '') == 2) selected @endif>Kementerian & Lembaga Pemerintah</option>
                                        <option value="3" @if(old('instansi_id', $respondent->instansi_id ?? '') == 3) selected @endif>TNI/POLRI/BIN/Kejaksaan</option>
                                        <option value="4" @if(old('instansi_id', $respondent->instansi_id ?? '') == 4) selected @endif>Pemerintah Daerah</option>
                                        <option value="5" @if(old('instansi_id', $respondent->instansi_id ?? '') == 5) selected @endif>Lembaga Internasional</option>
                                        <option value="6" @if(old('instansi_id', $respondent->instansi_id ?? '') == 6) selected @endif>Lembaga Penelitian & Pendidian</option>
                                        <option value="7" @if(old('instansi_id', $respondent->instansi_id ?? '') == 7) selected @endif>BUMN/BUMD</option>
                                        <option value="8" @if(old('instansi_id', $respondent->instansi_id ?? '') == 8) selected @endif>Swasta</option>
                                        <option value="9" @if(old('instansi_id', $respondent->instansi_id ?? '') == 9) selected @endif>Lainnya</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                    <div class="lainnya-input-wrapper" id="instansi_lainnya_wrapper" style="{{ old('instansi_id', $respondent->instansi_id ?? '') == 9 ? 'display: block;' : '' }}">
                                        <input type="text" class="form-control form-control-sm mt-2" name="instansi_lainnya" placeholder="Sebutkan lainnya..." value="{{ old('instansi_lainnya', $respondent->instansi_lainnya ?? '') }}" data-minlength="3">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="nama_instansi" class="form-label fw-bold">8. Nama Instansi</label>
                                    <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi', $respondent->nama_instansi ?? '') }}" data-required="true" data-minlength="3">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="pemanfaatan_id" class="form-label fw-bold">9. Pemanfaatan Utama Hasil Kunjungan</label>
                                    <select class="form-select" name="pemanfaatan_id" id="pemanfaatan_id" data-required="true">
                                        <option value="" @if(empty(old('pemanfaatan_id', $respondent->pemanfaatan_id ?? ''))) selected @endif disabled>-- Pilih salah satu --</option>
                                        <option value="1" @if(old('pemanfaatan_id', $respondent->pemanfaatan_id ?? '') == 1) selected @endif>Tugas Sekolah/Tugas Kuliah</option>
                                        <option value="2" @if(old('pemanfaatan_id', $respondent->pemanfaatan_id ?? '') == 2) selected @endif>Pemerintah</option>
                                        <option value="3" @if(old('pemanfaatan_id', $respondent->pemanfaatan_id ?? '') == 3) selected @endif>Komersial</option>
                                        <option value="4" @if(old('pemanfaatan_id', $respondent->pemanfaatan_id ?? '') == 4) selected @endif>Penelitian</option>
                                        <option value="5" @if(old('pemanfaatan_id', $respondent->pemanfaatan_id ?? '') == 5) selected @endif>Lainnya</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                    <div class="lainnya-input-wrapper" id="pemanfaatan_lainnya_wrapper" style="{{ old('pemanfaatan_id', $respondent->pemanfaatan_id ?? '') == 5 ? 'display: block;' : '' }}">
                                        <input type="text" class="form-control form-control-sm mt-2" name="pemanfaatan_lainnya" placeholder="Sebutkan lainnya..." value="{{ old('pemanfaatan_lainnya', $respondent->pemanfaatan_lainnya ?? '') }}" data-minlength="3">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3" data-required-checkbox="jenis_layanan[]">
                                    <label class="form-label d-block fw-bold">10. Jenis Layanan yang Digunakan (Wajib pilih minimal 1)</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Perpustakaan" id="jenis_perpustakaan" @if(in_array('Perpustakaan', old('jenis_layanan', $respondent->jenis_layanan ?? []))) checked @endif>
                                        <label class="form-check-label" for="jenis_perpustakaan">Perpustakaan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Konsultasi Statistik" id="jenis_konsultasi" @if(in_array('Konsultasi Statistik', old('jenis_layanan', $respondent->jenis_layanan ?? []))) checked @endif>
                                        <label class="form-check-label" for="jenis_konsultasi">Konsultasi Statistik</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Rekomendasi Kegiatan" id="jenis_rekomendasi" @if(in_array('Rekomendasi Kegiatan', old('jenis_layanan', $respondent->jenis_layanan ?? []))) checked @endif>
                                        <label class="form-check-label" for="jenis_rekomendasi">Rekomendasi Kegiatan Statistik</label>
                                    </div>
                                    <div class="invalid-feedback d-block"></div>
                                </div>

                                <div class="mb-3" data-required-checkbox="sarana_digunakan[]">
                                    <label class="form-label d-block fw-bold">11. Sarana yang digunakan (Wajib pilih minimal 1)</label>
                                    <div class="form-check">
                                        <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="PST Datang Langsung" id="sarana_pst_langsung" @if(in_array('PST Datang Langsung', old('sarana_digunakan', $respondent->sarana_digunakan ?? []))) checked @endif>
                                        <label class="form-check-label" for="sarana_pst_langsung">Pelayanan Statistik Terpadu (PST) datang langsung</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="PST Online" id="sarana_pst_online" @if(in_array('PST Online', old('sarana_digunakan', $respondent->sarana_digunakan ?? []))) checked @endif>
                                        <label class="form-check-label" for="sarana_pst_online">Pelayanan Statistik Terpadu online (pst.bps.go.id)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="Website BPS" id="sarana_website" @if(in_array('Website BPS', old('sarana_digunakan', $respondent->sarana_digunakan ?? []))) checked @endif>
                                        <label class="form-check-label" for="sarana_website">Website BPS (bps.go.id) / AllStats BPS</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="Surat/Email" id="sarana_email" @if(in_array('Surat/Email', old('sarana_digunakan', $respondent->sarana_digunakan ?? []))) checked @endif>
                                        <label class="form-check-label" for="sarana_email">Surat / Email</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="Aplikasi Chat" id="sarana_chat" @if(in_array('Aplikasi Chat', old('sarana_digunakan', $respondent->sarana_digunakan ?? []))) checked @endif>
                                        <label class="form-check-label" for="sarana_chat">Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input sarana-checkbox" type="checkbox" name="sarana_digunakan[]" value="Lainnya" id="sarana_lainnya_checkbox" @if(in_array('Lainnya', old('sarana_digunakan', $respondent->sarana_digunakan ?? []))) checked @endif>
                                        <label class="form-check-label" for="sarana_lainnya_checkbox">Lainnya</label>
                                    </div>
                                    <div class="invalid-feedback d-block"></div>
                                    <div class="lainnya-input-wrapper" id="sarana_lainnya_wrapper" style="{{ in_array('Lainnya', old('sarana_digunakan', $respondent->sarana_digunakan ?? [])) ? 'display: block;' : '' }}">
                                        <input type="text" class="form-control form-control-sm mt-2" name="sarana_lainnya" placeholder="Sebutkan sarana lainnya..." value="{{ old('sarana_lainnya', $respondent->sarana_lainnya ?? '') }}" data-minlength="3">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="invalid-feedback d-block"></div>
                                </div>

                                <div class="mb-3" data-required-radio="pernah_pengaduan">
                                    <label class="form-label d-block fw-bold">12. Apakah pernah melakukan pengaduan?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pernah_pengaduan" id="pengaduan_ya" value="Ya" @if(old('pernah_pengaduan', $respondent->pernah_pengaduan ?? '') == 'Ya') checked @endif>
                                        <label class="form-check-label" for="pengaduan_ya">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pernah_pengaduan" id="pengaduan_tidak" value="Tidak" @if(old('pernah_pengaduan', $respondent->pernah_pengaduan ?? '') == 'Tidak') checked @endif>
                                        <label class="form-check-label" for="pengaduan_tidak">Tidak</label>
                                    </div>
                                    <div class="invalid-feedback d-block"></div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" onclick="goPrev()">&laquo; Kembali</button>
                                    <button type="button" class="btn btn-primary" onclick="goNext()">Selanjutnya &raquo;</button>
                                </div>
                            </div>

                            <!-- {{-- ================================================================== --}}
                            {{-- =                               BLOK II                          = --}}
                            {{-- ================================================================== --}} -->
                            <div id="block-2" class="survey-block" style="display: none;">
                                <h5 class="mb-3 text-center">BLOK II. KEPUASAN TERHADAP LAYANAN</h5>
                                <p class="text-muted small">Menurut pendapat Saudara, bagaimana tingkat kepentingan dan tingkat kepuasan Saudara pada rincian pelayanan berikut?</p>
                                <p class="text-muted small">Klik angka yang Saudara pilih sesuai skala berikut (1: Sangat Tidak Penting/Puas, 10: Sangat Penting/Puas).</p>
                                <p class="text-muted small">Tingkat kepentingan adalah gambaran pelayanan yang seharusnya diberikan BPS sesuai dengan keinginan/harapan konsumen.</p>
                                <p class="text-muted small">Tingkat kepuasan adalah penilaian kinerja yang dirasakan konsumen.</p>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q1">
                                    <label class="form-label fw-bold"><span class="question-number fw-bold">1</span>. Informasi pelayanan pada unit layanan ini tersedia melalui media elektronik maupun non elektronik.</label>
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q1-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item
                                                    @if(($penilaian['q1']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q1-kepentingan-{{ $i }}">
                                                    {{ $i }}
                                                </label>
                                                <input type="radio" class="d-none"
                                                    name="penilaian[q1][kepentingan]"
                                                    id="q1-kepentingan-{{ $i }}"
                                                    value="{{ $i }}"
                                                    @checked(($penilaian['q1']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q1-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item
                                                    @if(($penilaian['q1']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q1-kepuasan-{{ $i }}">
                                                    {{ $i }}
                                                </label>
                                                <input type="radio" class="d-none"
                                                    name="penilaian[q1][kepuasan]"
                                                    id="q1-kepuasan-{{ $i }}"
                                                    value="{{ $i }}"
                                                    @checked(($penilaian['q1']['kepuasan'] ?? '') == $i)>
                                            @endfor

                                        </div>
                                    </div>
                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q2">
                                    <label class="form-label fw-bold"><span class="question-number">2</span>. Persyaratan pelayanan yang ditetapkan mudah dipenuhi/disiapkan oleh konsumen.</label>
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q2-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item
                                                    @if(($penilaian['q2']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q2-kepentingan-{{ $i }}">
                                                    {{ $i }}
                                                </label>
                                                <input type="radio" class="d-none"
                                                    name="penilaian[q2][kepentingan]"
                                                    id="q2-kepentingan-{{ $i }}"
                                                    value="{{ $i }}"
                                                    @checked(($penilaian['q2']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q2-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item
                                                    @if(($penilaian['q2']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q2-kepuasan-{{ $i }}">
                                                    {{ $i }}
                                                </label>
                                                <input type="radio" class="d-none"
                                                    name="penilaian[q2][kepuasan]"
                                                    id="q2-kepuasan-{{ $i }}"
                                                    value="{{ $i }}"
                                                    @checked(($penilaian['q2']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q3">
                                    <label class="form-label fw-bold"><span class="question-number">3</span>. Prosedur/alur pelayanan yang ditetapkan mudah diikuti/dilakukan.</label>
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q3-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item
                                                    @if(($penilaian['q3']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q3-kepentingan-{{ $i }}">
                                                    {{ $i }}
                                                </label>
                                                <input type="radio" class="d-none"
                                                    name="penilaian[q3][kepentingan]"
                                                    id="q3-kepentingan-{{ $i }}"
                                                    value="{{ $i }}"
                                                    @checked(($penilaian['q3']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q3-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item
                                                    @if(($penilaian['q3']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q3-kepuasan-{{ $i }}">
                                                    {{ $i }}
                                                </label>
                                                <input type="radio" class="d-none"
                                                    name="penilaian[q3][kepuasan]"
                                                    id="q3-kepuasan-{{ $i }}"
                                                    value="{{ $i }}"
                                                    @checked(($penilaian['q3']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q4">
                                    <label class="form-label fw-bold"><span class="question-number">4</span>. Jangka waktu penyelesaian pelayanan yang diterima sesuai dengan yang ditetapkan.</label>
                                    {{-- Q4 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q4-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q4']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q4-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q4][kepentingan]"
                                                    id="q4-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q4']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q4-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q4']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q4-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q4][kepuasan]"
                                                    id="q4-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q4']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q5">
                                    <label class="form-label fw-bold"><span class="question-number">5</span>. Biaya pelayanan yang dibayarkan sesuai dengan biaya yang ditetapkan.</label>
                                    {{-- Q5 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q5-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q5']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q5-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q5][kepentingan]"
                                                    id="q5-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q5']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q5-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q5']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q5-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q5][kepuasan]"
                                                    id="q5-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q5']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q6">
                                    <label class="form-label fw-bold"><span class="question-number">6</span>. Produk pelayanan yang diterima sesuai dengan yang dijanjikan.</label>
                                    {{-- Q6 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q6-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q6']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q6-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q6][kepentingan]"
                                                    id="q6-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q6']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q6-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q6']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q6-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q6][kepuasan]"
                                                    id="q6-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q6']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q7">
                                    <label class="form-label fw-bold"><span class="question-number">7</span>. Sarana dan prasarana pendukung pelayanan memberikan kenyamanan.</label>
                                    {{-- Q7 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q7-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q7']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q7-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q7][kepentingan]"
                                                    id="q7-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q7']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q7-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q7']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q7-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q7][kepuasan]"
                                                    id="q7-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q7']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q8">
                                    <label class="form-label fw-bold"><span class="question-number">8</span>. Data BPS mudah diakses melalui fasilitas utama yang digunakan.</label>
                                    <select class="form-select mb-3" id="fasilitas-utama-dropdown" name="penilaian[q8][fasilitas_utama]" data-required="true"></select>
                                    {{-- Q8 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q8-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q8']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q8-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q8][kepentingan]"
                                                    id="q8-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q8']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q8-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q8']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q8-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q8][kepuasan]"
                                                    id="q8-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q8']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q9">
                                    <label class="form-label fw-bold"><span class="question-number">9</span>. Petugas pelayanan dan/atau aplikasi pelayanan online merespon dengan baik.</label>
                                    {{-- Q9 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q9-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q9']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q9-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q9][kepentingan]"
                                                    id="q9-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q9']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q9-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q9']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q9-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q9][kepuasan]"
                                                    id="q9-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q9']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q10">
                                    <label class="form-label fw-bold"><span class="question-number">10</span>. Petugas pelayanan dan/atau aplikasi pelayanan online mampu memberikan informasi yang jelas.</label>
                                    {{-- Q10 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q10-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q10']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q10-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q10][kepentingan]"
                                                    id="q10-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q10']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q10-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q10']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q10-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q10][kepuasan]"
                                                    id="q10-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q10']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q11">
                                    <label class="form-label fw-bold"><span class="question-number">11</span>. Keberadaan fasilitas pengaduan PST mudah diketahui.</label>
                                    {{-- Q11 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q11-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q11']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q11-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q11][kepentingan]"
                                                    id="q11-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q11']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q11-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q11']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q11-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q11][kepuasan]"
                                                    id="q11-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q11']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div id="pertanyaan-12-wrapper" class="survey-question-blok2" style="display: none;" data-penilaian-question="q12">
                                    <div class="mb-4 p-3 border rounded">
                                        <label class="form-label fw-bold"><span class="question-number">12</span>. Proses penanganan pengaduan PST mudah diketahui, jelas, dan tidak berbelit-belit.</label>
                                        {{-- Q12 --}}
                                        <div class="mb-3">
                                            <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                            <div class="scale-container" id="scale-q12-kepentingan">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <label class="scale-item @if(($penilaian['q12']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                        for="q12-kepentingan-{{ $i }}">{{ $i }}</label>
                                                    <input type="radio" class="d-none" name="penilaian[q12][kepentingan]"
                                                        id="q12-kepentingan-{{ $i }}" value="{{ $i }}"
                                                        @checked(($penilaian['q12']['kepentingan'] ?? '') == $i)>
                                                @endfor
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                            <div class="scale-container" id="scale-q12-kepuasan">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <label class="scale-item @if(($penilaian['q12']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                        for="q12-kepuasan-{{ $i }}">{{ $i }}</label>
                                                    <input type="radio" class="d-none" name="penilaian[q12][kepuasan]"
                                                        id="q12-kepuasan-{{ $i }}" value="{{ $i }}"
                                                        @checked(($penilaian['q12']['kepuasan'] ?? '') == $i)>
                                                @endfor
                                            </div>
                                        </div>

                                        <div class="invalid-feedback d-block mt-2"></div>
                                    </div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q13">
                                    <label class="form-label fw-bold"><span class="question-number">13</span>. Tidak ada diskriminasi dalam pelayanan.</label>
                                    {{-- Q13 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q13-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q13']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q13-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q13][kepentingan]"
                                                    id="q13-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q13']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q13-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q13']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q13-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q13][kepuasan]"
                                                    id="q13-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q13']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q14">
                                    <label class="form-label fw-bold"><span class="question-number">14</span>. Tidak ada pelayanan di luar prosedur/kecurangan pelayanan.</label>
                                    {{-- Q14 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q14-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q14']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q14-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q14][kepentingan]"
                                                    id="q14-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q14']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q14-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q14']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q14-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q14][kepuasan]"
                                                    id="q14-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q14']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q15">
                                    <label class="form-label fw-bold"><span class="question-number">15</span>. Tidak ada penerimaan gratifikasi.</label>
                                    {{-- Q15 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q15-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q15']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q15-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q15][kepentingan]"
                                                    id="q15-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q15']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q15-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q15']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q15-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q15][kepuasan]"
                                                    id="q15-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q15']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q16">
                                    <label class="form-label fw-bold"><span class="question-number">16</span>. Tidak ada pungutan liar (pungli) dalam pelayanan.</label>
                                    {{-- Q16 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q16-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q16']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q16-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q16][kepentingan]"
                                                    id="q16-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q16']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q16-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q16']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q16-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q16][kepuasan]"
                                                    id="q16-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q16']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="mb-4 p-3 border rounded survey-question-blok2" data-penilaian-question="q17">
                                    <label class="form-label fw-bold"><span class="question-number">17</span>. Tidak ada praktik percaloan dalam pelayanan.</label>
                                    {{-- Q17 --}}
                                    <div class="mb-3">
                                        <span class="badge bg-warning rating-label">Tingkat Kepentingan (harapan konsumen)</span>
                                        <div class="scale-container" id="scale-q17-kepentingan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q17']['kepentingan'] ?? '') == $i) scale-selected @endif"
                                                    for="q17-kepentingan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q17][kepentingan]"
                                                    id="q17-kepentingan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q17']['kepentingan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info rating-label">Tingkat Kepuasan (penilaian konsumen)</span>
                                        <div class="scale-container" id="scale-q17-kepuasan">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <label class="scale-item @if(($penilaian['q17']['kepuasan'] ?? '') == $i) scale-selected @endif"
                                                    for="q17-kepuasan-{{ $i }}">{{ $i }}</label>
                                                <input type="radio" class="d-none" name="penilaian[q17][kepuasan]"
                                                    id="q17-kepuasan-{{ $i }}" value="{{ $i }}"
                                                    @checked(($penilaian['q17']['kepuasan'] ?? '') == $i)>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="invalid-feedback d-block mt-2"></div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" onclick="goPrev()">&laquo; Kembali</button>
                                    <button type="button" class="btn btn-primary" onclick="goNext()">Selanjutnya &raquo;</button>
                                </div>
                            </div>

                            <!-- {{-- ================================================================== --}}
                            {{-- =                           BLOK III                             = --}}
                            {{-- ================================================================== --}} -->
                            <div id="block-3" class="survey-block" style="display: none;">
                                <h5 class="mb-3 text-center">BLOK III. KEBUTUHAN DATA</h5>
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
                                                <th>Tahun Jenis Data</th>
                                                <th>Level Data</th>
                                                <th>Periode Data</th>
                                                <th>Data Diperoleh</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="kebutuhanDataTableBody" data-required-table="true">
                                            <tr id="kebutuhan-data-placeholder">
                                                <td colspan="8" class="text-center text-muted">Belum ada data yang ditambahkan.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="invalid-feedback d-block"></div> {{-- Tambahkan wadah error ini --}}
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" onclick="goPrev()">&laquo; Kembali</button>
                                    <button type="button" class="btn btn-primary" onclick="goNext()">Selanjutnya &raquo;</button>
                                </div>
                            </div>


                            <!-- {{-- ================================================================== --}}
                            {{-- =                                BLOK IV                               = --}}
                            {{-- ================================================================== --}} -->
                            <div id="block-4" class="survey-block" style="display: none;">
                                <h5 class="mb-3 text-center">BLOK IV. CATATAN</h5>
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Tuliskan kritik dan saran terhadap produk dan layanan data/informasi statistik yang disediakan oleh BPS.</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="5">{{ old('catatan', $respondent->catatan ?? '') }}</textarea>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" onclick="goPrev()">&laquo; Kembali</button>
                                    <button type="submit" class="btn btn-success">Kirim Survei</button>
                                </div>
                            </div>
                        </form>
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
                        <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="wilayah_data" class="form-label">2. Wilayah Data</label>
                            <input type="text" class="form-control" id="wilayah_data">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">3. Tahun Jenis Data</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="tahun_awal" placeholder="Tahun Awal" min="1900" max="{{ date('Y') }}">
                                <span class="input-group-text">s/d</span>
                                <input type="number" class="form-control" id="tahun_akhir" placeholder="Tahun Akhir" min="1900" max="{{ date('Y') }}">
                            </div>
                            <div class="invalid-feedback d-block"></div>
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
                            <input type="text" class="form-control" id="tahun_publikasi" min="1900" max="2100">
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

<script>
  // Value lama dari dropdown fasilitas q8 (bisa null)
  const oldFasilitas = {!! json_encode($oldFasilitas) !!};
</script>


{{-- JavaScript untuk membuat formulir multi-step dan mengaktifkan skala --}}
<script>
    // --- VARIABEL GLOBAL ---
    let kebutuhanDataArray = [];
    let currentBlock = 0;
    const totalBlocks = 5;
    const progressBar = document.getElementById('progressBar');
    const blockTitles = ["PETUGAS PST","BLOK I", "BLOK II", "BLOK III", "BLOK IV"];
    const surveyForm = document.getElementById('surveyForm');

    window.renderKebutuhanDataTable = function() {
        const tableBody = document.getElementById('kebutuhanDataTableBody');
        const hiddenJsonInput = document.getElementById('kebutuhan_data_json');

        // Reset isi tabel
        tableBody.innerHTML = '';

        if (kebutuhanDataArray.length === 0) {
            // Buat ulang row placeholder
            const placeholderRow = document.createElement('tr');
            placeholderRow.id = 'kebutuhan-data-placeholder';
            placeholderRow.innerHTML = `
            <td colspan="8" class="text-center text-muted">
                Belum ada data yang ditambahkan.
            </td>`;
            tableBody.appendChild(placeholderRow);
        } else {
            kebutuhanDataArray.forEach((data, index) => {
                const row = document.createElement('tr');
                
                // Logika baru yang pintar untuk menggabungkan tahun_awal dan tahun_akhir
                let tahunText = '-';
                if (data.tahun_awal) {
                    tahunText = data.tahun_awal;
                    if (data.tahun_akhir) {
                        tahunText += ` s/d ${data.tahun_akhir}`;
                    }
                } else if (data.tahun_data) { // Ini fallback jika ada data format lama
                    tahunText = data.tahun_data;
                }

                // 'Menggambar' baris tabel dengan data yang benar
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${data.rincian_data || '-'}</td>
                    <td>${data.wilayah_data || '-'}</td>
                    <td>${tahunText}</td>
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

        // Update hidden input untuk form submit
        hiddenJsonInput.value = JSON.stringify(kebutuhanDataArray);
        };


    // --- FUNGSI VALIDASI UTAMA (DENGAN AUTO-SCROLL) ---
    function validateBlock(blockNumber) {
        let isBlockValid = true;
        let firstInvalidField = null;
        const block = document.getElementById('block-' + blockNumber);
        if (!block) return true;

        block.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        block.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

        block.querySelectorAll('input:not([type="hidden"]), select, textarea').forEach(field => {
            if (field.offsetParent === null || field.disabled) return;

            let errorMessage = '';
            const value = field.value.trim();

            if (field.dataset.required === 'true' && value === '') {
                errorMessage = 'Isian ini wajib diisi.';
            } else if (value !== '') {
                if (field.dataset.minlength && value.length < parseInt(field.dataset.minlength, 10)) {
                    errorMessage = `Minimal harus ${field.dataset.minlength} karakter.`;
                } else if (field.dataset.email && !/^\S+@\S+\.\S+$/.test(value)) {
                    errorMessage = 'Format email tidak valid.';
                } else if (field.dataset.numeric && !/^\d+$/.test(value)) {
                    errorMessage = 'Isian ini harus berupa angka.';
                }
            }

            if (errorMessage) {
                isBlockValid = false;
                field.classList.add('is-invalid');
                const errorContainer = field.parentElement.querySelector('.invalid-feedback');
                if (errorContainer) errorContainer.textContent = errorMessage;
                if (!firstInvalidField) firstInvalidField = field;
            }
        });

        block.querySelectorAll('[data-required-radio]').forEach(group => {
            const name = group.dataset.requiredRadio;
            if (!block.querySelector(`input[name="${name}"]:checked`)) {
                isBlockValid = false;
                const errorContainer = group.parentElement.querySelector('.invalid-feedback');
                if (errorContainer) errorContainer.textContent = 'Harap pilih salah satu opsi.';
                if (!firstInvalidField) firstInvalidField = group;

                // [TAMBAHAN BARU]
                // Tambahkan kelas 'is-invalid' ke setiap radio button dalam grup ini
                // agar semuanya ikut menjadi merah.
                group.querySelectorAll(`input[name="${name}"]`).forEach(radio => {
                    radio.classList.add('is-invalid');
                });
            }
        });

        block.querySelectorAll('[data-required-checkbox]').forEach(group => {
            const name = group.dataset.requiredCheckbox;
            if (!block.querySelector(`input[name="${name}"]:checked`)) {
                isBlockValid = false;
                const errorContainer = group.querySelector('.invalid-feedback');
                if (errorContainer) errorContainer.textContent = 'Harap pilih minimal satu opsi.';
                if (!firstInvalidField) firstInvalidField = group;
            }
        });

        if (blockNumber === 0) {
            const petugasLainnyaRadio = document.getElementById('petugas_lainnya');
            const petugasLainnyaInput = document.getElementById('petugas_lainnya_nama');

            // Jika radio 'Lainnya' dipilih TAPI input teksnya kosong
            if (petugasLainnyaRadio.checked && petugasLainnyaInput.value.trim() === '') {
                isBlockValid = false;
                petugasLainnyaInput.classList.add('is-invalid');
                const errorContainer = petugasLainnyaInput.parentElement.querySelector('.invalid-feedback');
                if (errorContainer) errorContainer.textContent = 'Nama petugas lainnya wajib diisi.';
                if (!firstInvalidField) firstInvalidField = petugasLainnyaInput;
            }
        }

        if (blockNumber === 2) {
            block.querySelectorAll('[data-penilaian-question]').forEach(q => {
                if (q.offsetParent !== null) {
                    const questionId = q.dataset.penilaianQuestion;
                    const kepentingan = q.querySelector(`input[name="penilaian[${questionId}][kepentingan]"]:checked`);
                    const kepuasan = q.querySelector(`input[name="penilaian[${questionId}][kepuasan]"]:checked`);
                    if (!kepentingan || !kepuasan) {
                        isBlockValid = false;
                        const errorContainer = q.querySelector('.invalid-feedback');
                        if (errorContainer) errorContainer.textContent = 'Harap isi tingkat kepentingan dan kepuasan.';
                        if (!firstInvalidField) firstInvalidField = q;
                    }
                }
            });
        }

        // --- TAMBAHAN BARU: Validasi Tabel Dinamis ---
        block.querySelectorAll('[data-required-table]').forEach(tableBody => {
            // Cek apakah di dalam tbody hanya ada 1 baris (yaitu baris placeholder)
            if (tableBody.childElementCount <= 1 && tableBody.querySelector('#kebutuhan-data-placeholder')) {
                isBlockValid = false;
                const errorContainer = tableBody.parentElement.nextElementSibling; // Cari div.invalid-feedback
                if (errorContainer) {
                    errorContainer.textContent = 'Harap tambahkan minimal satu baris data.';
                }
                if (!firstInvalidField) firstInvalidField = tableBody.parentElement; // Sorot tabelnya
            }
        });

        if (!isBlockValid && firstInvalidField) {
            firstInvalidField.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        return isBlockValid;
    }

    


    // --- FUNGSI NAVIGASI & HELPER LAINNYA ---
    function showBlock(blockNumber) {
        document.querySelectorAll('.survey-block').forEach(block => block.style.display = 'none');
        document.getElementById(`block-${blockNumber}`).style.display = 'block';

        const progress = ((blockNumber + 1) / totalBlocks) * 100;
        progressBar.style.width = `${progress}%`;
        progressBar.textContent = blockTitles[blockNumber];

        window.scrollTo(0, 0);

        if (blockNumber === 4) {
            renderKebutuhanDataTable();
        }
    }

    // FUNGSI YANG HILANG SEBELUMNYA
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
        // **Pre-select jawaban lama jika masih valid**
        if (oldFasilitas && [...dropdown.options].some(o => o.value === oldFasilitas)) {
            dropdown.value = oldFasilitas;
        }
    }

    // FUNGSI YANG HILANG SEBELUMNYA
    // GANTI FUNGSI LAMA ANDA DENGAN YANG BARU DAN LEBIH ANDAL INI
    function handlePengaduanQuestion() {
        const wrapper = document.getElementById('pertanyaan-12-wrapper');
        const radioYa = document.getElementById('pengaduan_ya').checked;

        // 1. Atur visibilitas pertanyaan 12
        wrapper.style.display = radioYa ? 'block' : 'none';

        // 2. Gunakan setTimeout untuk memberi jeda sesaat pada browser
        //    sebelum melakukan penomoran ulang. Ini untuk mengatasi masalah timing.
        setTimeout(function() {
            let visibleQuestionCounter = 1;
            document.querySelectorAll('#block-2 .survey-question-blok2').forEach(questionDiv => {
                // offsetParent adalah cara yang andal untuk memeriksa apakah elemen benar-benar terlihat
                if (questionDiv.offsetParent !== null) {
                    const numberSpan = questionDiv.querySelector('.question-number');
                    if (numberSpan) {
                        numberSpan.textContent = visibleQuestionCounter;
                        visibleQuestionCounter++;
                    }
                }
            });
        }, 0); // Jeda 0 milidetik sudah cukup untuk trik ini
    }

    // Tempelkan dua fungsi baru ini
    function goNext() {
        if (!validateBlock(currentBlock)) {
            return; // Hentikan jika blok saat ini tidak valid
        }

        // [BAGIAN BARU]
        // Jika kita akan pindah DARI Blok I KE Blok II
        if (currentBlock === 1) {
            updateFasilitasDropdown(); // Panggil fungsi untuk mengisi dropdown
            handlePengaduanQuestion(); // Panggil juga fungsi untuk pertanyaan pengaduan
        }
        // [AKHIR BAGIAN BARU]

        let nextBlockNumber = currentBlock + 1;

        // --- LOGIKA LONCAT HALAMAN (KHUSUS DARI BLOK II) ---
        if (currentBlock === 2) { 
            const jenisLayanan = [];
            // Ambil semua nilai dari checkbox "Jenis Layanan" yang ada di Blok I
            document.querySelectorAll('input[name="jenis_layanan[]"]:checked').forEach(checkbox => {
                jenisLayanan.push(checkbox.value);
            });

            // Cek kondisinya: jika HANYA "Rekomendasi Kegiatan Statistik" yang dipilih
            if (jenisLayanan.length === 1 && jenisLayanan[0] === 'Rekomendasi Kegiatan') {
                console.log('Hanya Rekomendasi Kegiatan dipilih. Melompati Blok III...');
                nextBlockNumber = 4; // Langsung loncat ke Blok IV
            }
        }
        // --- AKHIR LOGIKA LONCAT HALAMAN ---

        if (nextBlockNumber < totalBlocks) {
            currentBlock = nextBlockNumber;
            showBlock(currentBlock);
        }
    }

    function goPrev() {
        let prevBlockNumber = currentBlock - 1;

        // --- LOGIKA LONCAT HALAMAN (KHUSUS DARI BLOK IV) ---
        if (currentBlock === 4) {
            const jenisLayanan = [];
            document.querySelectorAll('input[name="jenis_layanan[]"]:checked').forEach(checkbox => {
                jenisLayanan.push(checkbox.value);
            });

            if (jenisLayanan.length === 1 && jenisLayanan[0] === 'Rekomendasi Kegiatan') {
                console.log('Kembali dari Blok IV, melompati Blok III...');
                prevBlockNumber = 2; // Langsung loncat kembali ke Blok II
            }
        }
        // --- AKHIR LOGIKA LONCAT HALAMAN ---

        if (prevBlockNumber >= 0) {
            currentBlock = prevBlockNumber;
            showBlock(currentBlock);
        }
    }

    // --- EVENT LISTENER UTAMA ---
    document.addEventListener('DOMContentLoaded', function() {
        const petugasRadios = document.querySelectorAll('input[name="petugas_id"]');
        const lainnyaContainer = document.getElementById('lainnya_container');
        const lainnyaInput = document.getElementById('petugas_lainnya_nama');

        petugasRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'lainnya') {
                    lainnyaContainer.style.display = 'block';
                    lainnyaInput.setAttribute('required', 'required');
                } else {
                    lainnyaContainer.style.display = 'none';
                    lainnyaInput.removeAttribute('required');
                    lainnyaInput.value = '';
                }
            });
        });

        updateFasilitasDropdown();
        // if (oldFasilitas) {
        //     const dd = document.getElementById('fasilitas-utama-dropdown');
        //     if ([...dd.options].some(o=>o.value===oldFasilitas)) dd.value = oldFasilitas;
        // }
        showBlock(currentBlock);

        document.querySelectorAll('input[name="pernah_pengaduan"]').forEach(radio => {
            radio.addEventListener('change', handlePengaduanQuestion);
        });

        document.querySelectorAll('.scale-item').forEach(item => {
            item.addEventListener('click', function() {
                const parentContainer = this.closest('.scale-container');
                parentContainer.querySelectorAll('.scale-item').forEach(sibling => sibling.classList.remove('scale-selected'));
                this.classList.add('scale-selected');
            });
        });

        function handleLainnya(selectId, wrapperId, lainnyaValue) {
            const select = document.getElementById(selectId);
            const wrapper = document.getElementById(wrapperId);
            const input = wrapper.querySelector('input');

            if (!select) return;

            select.addEventListener('change', function() {
                const isLainnya = this.value === lainnyaValue;
                wrapper.style.display = isLainnya ? 'block' : 'none';
                if (input) {
                    input.dataset.required = isLainnya;
                    if (!isLainnya) {
                        input.value = '';
                        input.classList.remove('is-invalid');
                        const errorContainer = input.parentElement.querySelector('.invalid-feedback');
                        if (errorContainer) errorContainer.textContent = '';
                    }
                }
            });
        }

        handleLainnya('pekerjaan_id', 'pekerjaan_lainnya_wrapper', '7');
        handleLainnya('instansi_id', 'instansi_lainnya_wrapper', '9');
        handleLainnya('pemanfaatan_id', 'pemanfaatan_lainnya_wrapper', '5');

        const saranaLainnyaCheckbox = document.getElementById('sarana_lainnya_checkbox');
        const saranaLainnyaWrapper = document.getElementById('sarana_lainnya_wrapper');
        const saranaLainnyaInput = saranaLainnyaWrapper.querySelector('input');

        saranaLainnyaCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            saranaLainnyaWrapper.style.display = isChecked ? 'block' : 'none';
            saranaLainnyaInput.dataset.required = isChecked;
            if (!isChecked) {
                saranaLainnyaInput.value = '';
                saranaLainnyaInput.classList.remove('is-invalid');
                const errorContainer = saranaLainnyaInput.parentElement.querySelector('.invalid-feedback');
                if (errorContainer) errorContainer.textContent = '';
            }
        });



        // --- LOGIKA BLOK III ---
        // --- LOGIKA BARU UNTUK BLOK III (ADD, VIEW, EDIT, DELETE) ---

        // --- LOGIKA BARU UNTUK BLOK III (DENGAN PENANGANAN "LAINNYA") ---

        // --- LOGIKA BARU UNTUK BLOK III (DENGAN PENANGANAN "LAINNYA" UNTUK LEVEL & PERIODE) ---

        // --- LOGIKA BARU UNTUK BLOK III (DENGAN KONDISI & PENOMORAN OTOMATIS) ---

        // let kebutuhanDataArray = [];

        // parsing JSON lama ke kebutuhanDataArray
        const existing = document.getElementById('kebutuhan_data_json').value;
        try {
            kebutuhanDataArray = existing ? JSON.parse(existing) : [];
        } catch { kebutuhanDataArray = []; }

        // renderKebutuhanDataTable();

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

        renderKebutuhanDataTable();

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
            document.getElementById('tahun_awal').value = data.tahun_awal || '';
            document.getElementById('tahun_akhir').value = data.tahun_akhir || '';

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

        simpanBtn.addEventListener('click', function() {
            // Bersihkan error sebelumnya di dalam modal
            modalForm.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            modalForm.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

            let isModalValid = true;
            let firstInvalidModalField = null;

            // Fungsi kecil untuk menampilkan error (ini sudah ada di kode Anda)
            function showError(fieldId, message) {
                isModalValid = false;
                const field = document.getElementById(fieldId);
                if (!field) return;
                field.classList.add('is-invalid');
                
                let errorContainer = field.parentElement.querySelector('.invalid-feedback');
                // Khusus untuk input-group
                if (field.parentElement.classList.contains('input-group')) {
                    errorContainer = field.parentElement.parentElement.querySelector('.invalid-feedback');
                }

                if (errorContainer) {
                    errorContainer.textContent = message;
                }
                if (!firstInvalidModalField) {
                    firstInvalidModalField = field;
                }
            }

            // Ambil semua nilai dari form modal
            const formData = {
                rincian_data: modalElement.querySelector('#rincian_data').value.trim(),
                wilayah_data: modalElement.querySelector('#wilayah_data').value.trim(),

                tahun_awal: modalElement.querySelector('#tahun_awal').value.trim(),
                tahun_akhir: modalElement.querySelector('#tahun_akhir').value.trim(),

                level_data: modalElement.querySelector('#level_data').value,
                level_data_lainnya: modalElement.querySelector('#level_data_lainnya').value.trim(),
                periode_data: modalElement.querySelector('#periode_data').value,
                periode_data_lainnya: modalElement.querySelector('#periode_data_lainnya').value.trim(),
                data_diperoleh: modalElement.querySelector('#data_diperoleh').value,
                jenis_publikasi: modalElement.querySelector('#jenis_publikasi').value,
                judul_publikasi: modalElement.querySelector('#judul_publikasi').value.trim(),
                tahun_publikasi: modalElement.querySelector('#tahun_publikasi').value.trim(),
                digunakan_perencanaan: modalElement.querySelector('input[name="digunakan_perencanaan"]:checked')?.value || null,
                kualitas_data: modalElement.querySelector('input[name="kualitas_data"]:checked')?.value || null,
            };

            // Fungsi kecil untuk menampilkan error
            // function showError(fieldId, message) {
            //     isModalValid = false;
            //     const field = document.getElementById(fieldId);
            //     field.classList.add('is-invalid');
            //     const errorContainer = field.parentElement.querySelector('.invalid-feedback');
            //     if (errorContainer) {
            //         errorContainer.textContent = message;
            //     }
            //     if (!firstInvalidModalField) {
            //         firstInvalidModalField = field;
            //     }
            // }

            // Lakukan validasi satu per satu
            if (!formData.rincian_data) showError('rincian_data', 'Rincian data wajib diisi.');
            if (!formData.wilayah_data) showError('wilayah_data', 'Wilayah data wajib diisi.');

            if (!formData.tahun_awal) {
                showError('tahun_awal', 'Tahun awal wajib diisi.');
            }
            if (!formData.tahun_akhir) { // <-- SEKARANG MENJADI WAJIB
                showError('tahun_akhir', 'Tahun akhir wajib diisi.');
            } else if (parseInt(formData.tahun_akhir) < parseInt(formData.tahun_awal)) {
                showError('tahun_akhir', 'Tahun akhir tidak boleh lebih kecil dari tahun awal.');
            }

            if (!formData.level_data) showError('level_data', 'Level data wajib dipilih.');
            if (formData.level_data === 'lainnya' && !formData.level_data_lainnya) {
                showError('level_data_lainnya', 'Harap sebutkan level lainnya.');
            }
            if (!formData.periode_data) showError('periode_data', 'Periode data wajib dipilih.');
            if (formData.periode_data === 'lainnya' && !formData.periode_data_lainnya) {
                showError('periode_data_lainnya', 'Harap sebutkan periode lainnya.');
            }
            if (!formData.data_diperoleh) showError('data_diperoleh', 'Opsi ini wajib dipilih.');

            // Validasi untuk pertanyaan tambahan jika terlihat
            if (pertanyaanTambahanWrapper.style.display === 'block') {
                if (!formData.jenis_publikasi) showError('jenis_publikasi', 'Jenis sumber data wajib dipilih.');
                if (!formData.judul_publikasi) showError('judul_publikasi', 'Judul publikasi wajib diisi.');
                if (!formData.tahun_publikasi) showError('tahun_publikasi', 'Tahun publikasi wajib diisi.');
                if (!formData.kualitas_data) {
                    // Untuk skala, kita bisa tampilkan error di dekatnya
                    isModalValid = false;
                    const scaleContainer = document.getElementById('modal-scale-kualitas');
                    if (!firstInvalidModalField) firstInvalidModalField = scaleContainer;
                    // Anda bisa menambahkan pesan error di bawah skala jika perlu
                }
            }

            // Jika tidak valid, hentikan proses dan scroll ke error pertama
            if (!isModalValid) {
                if (firstInvalidModalField) {
                    firstInvalidModalField.focus();
                    firstInvalidModalField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                return;
            }

            // Konversi ke integer saat akan disimpan
            formData.tahun_awal = parseInt(formData.tahun_awal) || null;
            formData.tahun_akhir = parseInt(formData.tahun_akhir) || null;

            // Jika valid, lanjutkan proses penyimpanan
            if (modalMode === 'add') {
                formData.id = Date.now(); // Buat ID unik sementara
                kebutuhanDataArray.push(formData);
            } else if (modalMode === 'edit') {
                const index = kebutuhanDataArray.findIndex(d => d.id === currentDataId);
                if (index !== -1) {
                    kebutuhanDataArray[index] = { ...kebutuhanDataArray[index], ...formData };
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

        // -- LISTENER FINAL UNTUK TOMBOL SUBMIT --
        // GANTI SELURUH FUNGSI addEventListener LAMA ANDA DENGAN YANG INI
        surveyForm.addEventListener('submit', function(event) {
            // 1. Hentikan dulu pengiriman form asli
            event.preventDefault();

            // 2. Cek kondisi apakah kita harus melewati Blok III
            const jenisLayanan = [];
            document.querySelectorAll('input[name="jenis_layanan[]"]:checked').forEach(checkbox => {
                jenisLayanan.push(checkbox.value);
            });
            const skipBlok3 = (jenisLayanan.length === 1 && jenisLayanan[0] === 'Rekomendasi Kegiatan');

            // 3. Lakukan validasi akhir untuk semua blok yang relevan
            let isFormValid = true;
            // Loop dari blok 0 (Petugas) sampai 4 (Catatan)
            for (let i = 0; i <= 4; i++) { 
                // Jika kita harus skip blok 3, jangan validasi blok 3
                if (skipBlok3 && i === 3) {
                    console.log('Validasi akhir: Melewati Blok 3...');
                    continue; // Lanjutkan ke iterasi berikutnya (Blok 4)
                }
                
                // Jalankan validasi seperti biasa
                if (!validateBlock(i)) {
                    isFormValid = false;
                    // Jika blok yang error bukan yang sedang aktif, pindah ke sana
                    if (i !== currentBlock) {
                        showBlock(i);
                    }
                    break; // Hentikan pengecekan jika sudah ada yang error
                }
            }

            // 4. Putuskan apa yang harus dilakukan
            if (!isFormValid) {
                // Jika tidak valid, tampilkan alert
                alert('Terdapat isian yang belum lengkap atau tidak sesuai format. Silakan periksa kembali bagian yang ditandai merah.');
            } else {
                // Jika semua valid, siapkan data JSON dan KIRIM FORM
                console.log('Semua validasi berhasil. Mengirim formulir...');
                // (Pastikan logika untuk mengisi hidden input JSON Anda ada di sini jika belum)
                // document.getElementById('penilaian_json').value = JSON.stringify(penilaianData);
                // document.getElementById('kebutuhan_data_json').value = JSON.stringify(kebutuhanDataArray);
                surveyForm.submit();
            }
        });



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

<script>
    // pushState agar “Back” tidak bisa mundur
    history.pushState(null, null, location.href);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, location.href);
    });
</script>

@endsection