@extends('layouts.app')

@section('title', 'Formulir Survei Penilaian Pelayanan')

@section('content')

<style>
    .scale-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
    }
    .scale-item {
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        transition: background-color 0.2s, color 0.2s;
    }
    .scale-item:hover {
        background-color: #e9ecef;
    }
    /* Kelas ini akan ditambahkan oleh JavaScript saat sebuah angka dipilih */
    .scale-item.scale-selected {
        background-color: #0d6efd; /* Warna biru primer Bootstrap */
        color: white;
        border-color: #0d6efd;
    }
    .rating-label {
        font-size: 0.85rem;
        font-weight: 500;
    }
    .lainnya-input-wrapper {
        display: none;
        margin-top: 10px;
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
                        <input type="hidden" name="kebutuhan_data_json" id="kebutuhan_data_json">

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
                                    <option value="1"><= SLTA/Sederajat</option>
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
                                    <input class="form-check-input" type="checkbox" name="jenis_layanan[]" value="Pembelian Publikasi" id="jenis_publikasi">
                                    <label class="form-check-label" for="jenis_publikasi">Pembelian Produk Statistik Berbayar: Publikasi BPS</label>
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

                        {{-- ================================================================== --}}
                        {{-- =                               BLOK III                               = --}}
                        {{-- ================================================================== --}}
                        <div id="block-3" class="survey-block" style="display: none;">
                            <h5 class="mb-3">BLOK III. Kebutuhan Data</h5>
                            <p class="text-muted">Isikan data-data yang dibutuhkan/dikonsultasikan dari BPS.</p>

                            {{-- Nanti di sini kita akan buat sistem "Tambah Kebutuhan Data" yang dinamis --}}
                            <button type="button" class="btn btn-success">Tambah Kebutuhan Data</button>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary" onclick="prevBlock(2)">&laquo; Kembali</button>
                                <button type="button" class="btn btn-primary" onclick="nextBlock(4)">Selanjutnya &raquo;</button>
                            </div>
                        </div>

                        {{-- ================================================================== --}}
                        {{-- =                                BLOK IV                               = --}}
                        {{-- ================================================================== --}}
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
    });
</script>
@endsection