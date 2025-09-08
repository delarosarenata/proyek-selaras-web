    @extends('layouts.app') {{-- Ganti dengan layout admin Anda jika ada --}}

    @section('title', 'Responden SELARAS')

    @section('content')

<style>
  /* ===== Palette */
  :root{
    --bg-page:#f3e2c7;        /* krem halaman */
    --ink:#0f172a;
    --muted:#64748b;

    /* tabel abu */
    --tbl-head:#e9ecef;       /* header abu terang */
    --tbl-row:#f6f7f9;        /* baris dasar abu muda */
    --tbl-row-alt:#eef1f4;    /* baris ganjil (striped) */
    --tbl-row-hover:#e7ebf0;  /* hover */
    --tbl-border:#d1d5db;

    --radius:20px;
    --shadow:0 14px 40px rgba(0,0,0,.12);
  }

  /* ===== Halaman = krem */
  html, body, #app, main, .content, .container-fluid { 
    background: var(--bg-page) !important; 
  }

  /* ===== Card konten = putih (biar kontras dengan krem) */
  .responden-page .card{
    background:#fff !important;
    border:1px solid rgba(0,0,0,.06);
    border-radius: var(--radius) !important;
    box-shadow: var(--shadow);
    overflow:hidden;
  }
  .responden-page .card-header{
    background:#fff !important;
    border-bottom:1px solid var(--tbl-border) !important;
  }
  .responden-page .card-body{ background:#fff !important; }

  /* ===== Area toolbar/search DataTables juga putih (jangan krem) */
  .responden-page .dataTables_wrapper .top,
  .responden-page .dt-toolbar{ 
    background:#fff !important; 
  }

  /* ===== Tabel = abu-abu */
  #respondenTable{
    /* paksa variabel Bootstrap agar gak kebawa warna lain */
    --bs-table-bg: var(--tbl-row);
    --bs-table-striped-bg: var(--tbl-row-alt);
    --bs-table-hover-bg: var(--tbl-row-hover);
    --bs-table-border-color: var(--tbl-border);
  }
  #respondenTable thead th{
    background: var(--tbl-head) !important;
    color: var(--ink) !important;
    border-bottom:1px solid var(--tbl-border) !important;
    font-weight:700 !important;
    text-transform:uppercase;
    font-size:.8rem;
  }
  /* dasar baris abu */
  #respondenTable tbody td{ 
    background: var(--tbl-row) !important; 
    border-bottom:1px solid var(--tbl-border) !important;
  }
  /* zebra */
  #respondenTable.table-striped > tbody > tr:nth-of-type(odd) > *{
    background: var(--tbl-row-alt) !important;
  }
  /* hover */
  #respondenTable.table-hover > tbody > tr:hover > *{
    background: var(--tbl-row-hover) !important;
  }
  #detailModal .modal-content{
  background:#fff !important;
  border-radius:20px;
  border:1px solid #d1d5db;
  }
  #detailModal .modal-header,
  #detailModal .modal-footer{
    background:#fff !important;
    border-color:#d1d5db !important;
  }
  #detailModal .modal-body{
    background:#fff !important;
  }

  /* tab navigasi dalam modal */
  #detailModal .nav-tabs{
    background:#f8f9fa !important; /* abu terang */
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:6px;
  }
  #detailModal .nav-tabs .nav-link{
    border:none;
    border-radius:8px;
    font-weight:600;
    color:#64748b;
  }
  #detailModal .nav-tabs .nav-link.active{
    background:#0d6efd !important;
    color:#fff !important;
  }

  /* tabel dalam modal */
  #detailModal table{
    --bs-table-bg:#fff;
    --bs-table-striped-bg:#f6f7f9;
    --bs-table-hover-bg:#eef2f6;
    --bs-table-border-color:#d1d5db;
  }
  #detailModal thead th{
    background:#e9ecef !important;
    color:#0f172a !important;
    font-weight:700;
  }
  #detailModal tbody td{
    background:#fff !important;
    border-bottom:1px solid #d1d5db;
  }
  #detailModal tbody tr:nth-of-type(odd) td{
    background:#f6f7f9 !important;
  }
  #detailModal tbody tr:hover td{
    background:#eef2f6 !important;
  }
  /* ===== PERAPIHAN BLOK III DI MODAL ===== */
  /* Legain padding & tinggi baris tabel di dalam modal */
  #detailModal .table-sm th,
  #detailModal .table-sm td{
    padding: .9rem 1rem !important;   /* default .table-sm kecil banget */
    line-height: 1.5;
    vertical-align: top;
  }

  /* Kolom kiri (label) agak fixed width + kontras sedikit */
  #detailModal .table-sm th{
    width: 32%;
    white-space: nowrap;
    color: #334155;
    background: #f8fafc !important;
    font-weight: 600;
  }

  /* Kolom kanan (nilai) biar bisa wrap rapi */
  #detailModal .table-sm td{
    color:#111827;
    word-break: break-word;
  }

  /* Judul bagian “Rincian Tambahan” kasih breathing room */
  #detailModal .table-sm tr.table-info > td,
  #detailModal .table-sm tr.table-info > th{
    padding: .7rem 1rem !important;
  }

  /* Sedikit ruang di dalam modal */
  #detailModal .modal-body{
    padding: 1.25rem 1.5rem !important;
  }

  /* Responsif: di layar sempit, label lebih lebar sedikit */
  @media (max-width: 576px){
    #detailModal .table-sm th{ width: 40%; }
  }

</style>


<div class="responden-page">
    <div class="container">
        <div class="card content-card shadow-sm">
            <div class="card-header">
                <h3 class="m-3 text-center fw-bold">DAFTAR RESPONDEN SELARAS</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table id="respondenTable" class="table table-striped table-hover" style="width:100%">
                        <thead style="vertical-align: middle;" class="table-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">No. HP</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Nama Instansi</th>
                                <th class="text-center">Tanggal & Jam Cacah</th>
                                <th class="text-center">Petugas Dinilai</th>  {{-- <-- KOLOM BARU 1 --}}
                                <th class="text-center">Status Entri SKD</th>
                                <th class="text-center" style="width: 220px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($respondents as $index => $respondent)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $respondent->nama }}</td>
                                <td>{{ $respondent->no_hp }}</td>
                                <td>{{ $respondent->email }}</td>
                                <td>{{ $respondent->nama_instansi }}</td>
                                <td>{{ $respondent->created_at->format('d M Y, H:i') }} WITA</td>
                                <td>
                                    @if($respondent->petugas)
                                        <!-- {{-- Jika petugas spesifik dipilih --}} -->
                                        {{ $respondent->petugas->nama }}
                                    @elseif($respondent->petugas_lainnya_nama)
                                        <!-- {{-- Jika 'Lainnya' diisi --}} -->
                                        <span class="text-info">{{ $respondent->petugas_lainnya_nama }} (Lainnya)</span>
                                    @else
                                        <!-- {{-- Jika 'Tidak Ingat' dipilih --}} -->
                                        <span class="text-muted">Tidak Diketahui</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <!-- @php
                                        $status = $respondent->status;
                                        $badgeClass = '';
                                        switch ($status) {
                                            case 'sukses':
                                                $badgeClass = 'bg-success';
                                                break;
                                            case 'gagal':
                                                $badgeClass = 'bg-danger';
                                                break;
                                            default: // untuk 'pending'
                                                $badgeClass = 'bg-secondary';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }} text-capitalize">{{ $status }}</span>
                                     <span id="status-{{ $respondent->id }}">{{ $respondent->status }}</span> -->

                                     @php
                                        $status = $respondent->status;
                                        $badgeClass = match($status) {
                                            'sukses'  => 'badge bg-success',
                                            'gagal'   => 'badge bg-danger',
                                            'pending' => 'badge bg-secondary',
                                            default   => 'badge bg-light text-dark',
                                        };
                                    @endphp

                                    <span id="status-{{ $respondent->id }}"
                                        class="{{ $badgeClass }} text-capitalize"
                                        data-status="{{ $status }}">
                                    {{ $status }}
                                    </span>


                                </td>

                                <td>
                                    {{-- Tombol ini bisa dilihat oleh SEMUA role yang bisa akses halaman ini --}}
                                    <button class="btn btn-info btn-sm" onclick="lihatDetail('{{ route('admin.responden.detail', $respondent) }}')">Detail</button>
                                    <button id="copy-link-{{ $respondent->id }}" class="btn btn-secondary btn-sm" onclick="copyLink('{{ route('kuesioner.edit', $respondent) }}')">Salin</button>
                                    
                                    {{-- ======================================================= --}}
                                    {{-- Tombol-tombol di bawah ini HANYA bisa dilihat oleh ADMIN --}}
                                    {{-- ======================================================= --}}
                                    @can('perform-admin-actions')
                                        
                                        {{-- Tombol Bot hanya muncul jika statusnya BUKAN sukses atau sedang diproses --}}
                                        @if(!in_array($respondent->status, ['sukses']))
                                            <!-- <form action="{{ route('admin.run_bot', $respondent) }}" method="POST" class="d-inline" onsubmit="return confirm('Jalankan bot untuk responden ini?');">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Jalankan Bot Entri"></button>
                                            </form> -->
                                            <!-- <form action="{{ route('admin.run_bot', $respondent) }}" method="POST" class="d-inline form-confirm" onsubmit="return confirm('Jalankan bot untuk responden ini?');">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Jalankan Bot Entri">🤖</button>
                                            </form> -->
                                            <!-- <form action="{{ route('admin.run_bot', $respondent) }}" method="POST" class="d-inline form-confirm" data-swal-title="Jalankan Bot?" data-swal-text="Proses ini akan menjalankan entri otomatis untuk responden ini.">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Jalankan Bot Entri">🤖</button>
                                            </form> -->
                                            <form class="run-bot-form d-inline form-confirm"
                                                action="{{ route('admin.run_bot', $respondent) }}"
                                                method="POST"
                                                onsubmit="return false;"
                                                data-id="{{ $respondent->id }}"
                                                data-status-url="{{ route('admin.respondent.status', $respondent) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Jalankan Bot Entri">🤖</button>
                                            </form>

                                        @endif

                                    @endcan

                                        {{-- Tombol Hapus --}}
                                        <!-- <form action="{{ route('admin.responden.destroy', $respondent) }}" method="POST" class="d-inline form-confirm" onsubmit="return confirm('Anda yakin ingin menghapus permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form> -->
                                        <form action="{{ route('admin.responden.destroy', $respondent) }}" method="POST" class="d-inline form-confirm" data-swal-title="Yakin Hapus Permanen?" data-swal-text="Data responden yang sudah dihapus tidak bisa dikembalikan.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
            
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Belum ada data responden.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">Detail Jawaban Responden</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="detailContent">
                                <p class="text-center">Memuat data...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                </div>
            </div>
        </div>
    </div>
</div>


    @endsection

    @push('scripts')
<script>
    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#respondenTable').DataTable({
            responsive: true,
            // order: [[ 5, 'desc ' ]], // Urutkan berdasarkan kolom Tanggal
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
            },
        });
    });
    
    const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
    const detailContent = document.getElementById('detailContent');

    // KAMUS DATA UNTUK MENERJEMAHKAN KODE MENJADI TEKS
    const pendidikanMap = { 1: '<= SLTA/Sederajat', 2: 'D1/D2/D3', 3: 'D4/S1', 4: 'S2', 5: 'S3' };
    const pekerjaanMap = { 1: 'Pelajar/Mahasiswa', 2: 'Peneliti/Dosen', 3: 'ASN/TNI/POLRI', 4: 'Pegawai BUMN/BUMD', 5: 'Pegawai Swasta', 6: 'Wiraswasta', 7: 'Lainnya' };
    const instansiMap = { 1: 'Lembaga Negara', 2: 'Kementerian & Lembaga Pemerintah', 3: 'TNI/POLRI/BIN/Kejaksaan', 4: 'Pemerintah Daerah', 5: 'Lembaga Internasional', 6: 'Lembaga Penelitian & Pendidian', 7: 'BUMN/BUMD', 8: 'Swasta', 9: 'Lainnya' };
    const pemanfaatanMap = { 1: 'Tugas Sekolah/Tugas Kuliah', 2: 'Pemerintah', 3: 'Komersial', 4: 'Penelitian', 5: 'Lainnya' };
    const penilaianMap = {
        'q1': 'Informasi pelayanan pada unit layanan ini tersedia',
        'q2': 'Persyaratan pelayanan mudah dipenuhi',
        'q3': 'Prosedur/alur pelayanan mudah diikuti',
        'q4': 'Jangka waktu penyelesaian pelayanan sesuai',
        'q5': 'Biaya pelayanan sesuai dengan yang ditetapkan',
        'q6': 'Produk pelayanan sesuai dengan yang dijanjikan',
        'q7': 'Sarana dan prasarana memberikan kenyamanan',
        'q8': 'Data BPS mudah diakses melalui fasilitas utama',
        'q9': 'Petugas/aplikasi merespon dengan baik',
        'q10': 'Petugas/aplikasi memberikan informasi yang jelas',
        'q11': 'Keberadaan fasilitas pengaduan mudah diketahui',
        'q12': 'Proses penanganan pengaduan mudah dan jelas',
        'q13': 'Tidak ada diskriminasi dalam pelayanan',
        'q14': 'Tidak ada kecurangan pelayanan',
        'q15': 'Tidak ada penerimaan gratifikasi',
        'q16': 'Tidak ada pungutan liar (pungli)',
        'q17': 'Tidak ada praktik percaloan'
    };

    function lihatDetail(url) {
        detailContent.innerHTML = '<div class="text-center p-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        detailModal.show();
        fetch(url)
            .then(response => {
                if (!response.ok) { throw new Error('Network response was not ok'); }
                return response.json();
            })
            .then(data => {
                populateModal(data);
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                detailContent.innerHTML = '<div class="alert alert-danger">Gagal memuat data. Silakan coba lagi.</div>';
            });
    }

    function copyLink(link) {
        navigator.clipboard.writeText(link).then(() => {
            alert('Link edit berhasil disalin!');
        });
    }

    function populateModal(data) {
        let petugasDinilaiText = '<span class="text-muted">Tidak Diketahui</span>';
        if (data.petugas && data.petugas.nama) petugasDinilaiText = data.petugas.nama;
        else if (data.petugas_lainnya_nama) petugasDinilaiText = `${data.petugas_lainnya_nama} (Lainnya)`;
        
        let ratingBintangHtml = '<span class="text-muted">-</span>';
        if (data.rating) {
            ratingBintangHtml = Array.from({length: 5}, (_, i) => 
                `<span style="color: ${i < data.rating ? '#ffc107' : '#e0e0e0'}; font-size: 1.5rem;">&#9733;</span>`
            ).join('');
        }
        
        const penilaianPetugasHtml = `<h6 class="mb-3 fw-bold text-primary">Penilaian Terhadap Petugas</h6><table class="table table-sm table-bordered"><tbody><tr><th style="width: 30%;">Petugas</th><td>${petugasDinilaiText}</td></tr><tr><th>Rating</th><td>${ratingBintangHtml}</td></tr><tr><th>Kritik & Saran</th><td>${data.kritik_saran || '<em class="text-muted">Tidak ada.</em>'}</td></tr></tbody></table>`;
        const blok1Html = `<h6 class="mb-3 fw-bold text-primary">Informasi Responden</h6><table class="table table-sm table-bordered"><tbody><tr><th style="width: 30%;">Nama</th><td>${data.nama||'-'}</td></tr><tr><th>Email</th><td>${data.email||'-'}</td></tr><tr><th>No. HP</th><td>${data.no_hp||'-'}</td></tr><tr><th>Jenis Kelamin</th><td>${data.jenis_kelamin||'-'}</td></tr><tr><th>Pendidikan</th><td>${pendidikanMap[data.pendidikan_id]||'-'}</td></tr><tr><th>Pekerjaan</th><td>${data.pekerjaan_lainnya||pekerjaanMap[data.pekerjaan_id]||'-'}</td></tr><tr><th>Instansi</th><td>${data.instansi_lainnya||instansiMap[data.instansi_id]||'-'}</td></tr><tr><th>Nama Instansi</th><td>${data.nama_instansi||'-'}</td></tr><tr><th>Pemanfaatan</th><td>${data.pemanfaatan_lainnya||pemanfaatanMap[data.pemanfaatan_id]||'-'}</td></tr><tr><th>Jenis Layanan</th><td>${(data.jenis_layanan||[]).join(', ')||'-'}</td></tr><tr><th>Sarana</th><td>${(data.sarana_digunakan||[]).join(', ')||'-'}</td></tr><tr><th>Pengaduan?</th><td>${data.pernah_pengaduan||'-'}</td></tr></tbody></table>`;

        // let blok2Html = `<h6 class="mb-3 fw-bold text-primary">Penilaian Pelayanan</h6><table class="table table-sm table-bordered table-striped"><thead class="table-light"><tr><th>Aspek</th><th class="text-center">Penting</th><th class="text-center">Puas</th></tr></thead><tbody>`;
        // if (data.penilaian && Object.keys(data.penilaian).length > 0) {
        //     for (const [q, v] of Object.entries(data.penilaian)) {
        //         blok2Html += `<tr><td>${penilaianMap[q]||q}</td><td class="text-center">${v.kepentingan||'-'}</td><td class="text-center">${v.kepuasan||'-'}</td></tr>`;
        //     }
        // } else {
        //     blok2Html += `<tr><td colspan="3" class="text-center text-muted">Tidak ada data.</td></tr>`;
        // }
        // blok2Html += `</tbody></table>`;
            let blok2Html = `<h6 class="mb-3 fw-bold text-primary">Penilaian Terhadap Pelayanan</h6>`;
    
    // Cek apakah ada data fasilitas utama
    const fasilitasUtama = data.penilaian?.q8?.fasilitas_utama;

    if (fasilitasUtama) {
        blok2Html += `
            <div class="alert alert-light border mb-4">
                <strong class="d-block mb-1">Fasilitas Utama yang Dinilai:</strong>
                <span class="badge bg-primary fs-6">${fasilitasUtama}</span>
            </div>
        `;
    }

    blok2Html += `<table class="table table-sm table-bordered table-striped"><thead class="table-light"><tr><th>Aspek Pelayanan</th><th class="text-center">Tingkat Kepentingan</th><th class="text-center">Tingkat Kepuasan</th></tr></thead><tbody>`;
    if (data.penilaian && Object.keys(data.penilaian).length > 0) {
        for (const [q, v] of Object.entries(data.penilaian)) {
            const questionText = penilaianMap[q] || `Pertanyaan ${q.substring(1)}`;
            blok2Html += `<tr><td>${questionText}</td><td class="text-center">${v.kepentingan||'-'}</td><td class="text-center">${v.kepuasan||'-'}</td></tr>`;
        }
    } else {
        blok2Html += `<tr><td colspan="3" class="text-center text-muted">Tidak ada data penilaian.</td></tr>`;
    }
    blok2Html += `</tbody></table>`;

        const blok4Html = `<h6 class="mb-3 fw-bold text-primary">Catatan</h6><div class="p-3 bg-light rounded border"><p class="mb-0 fst-italic">${data.catatan||'Tidak ada.'}</p></div>`;

        detailContent.innerHTML = `<ul class="nav nav-tabs nav-fill mb-3" id="detailTab" role="tablist"><li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#penilaian-content">PENILAIAN</button></li><li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#blok1-content">BLOK I</button></li><li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#blok2-content">BLOK II</button></li><li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#blok3-content">BLOK III</button></li><li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#blok4-content">BLOK IV</button></li></ul><div class="tab-content"><div class="tab-pane fade show active" id="penilaian-content">${penilaianPetugasHtml}</div><div class="tab-pane fade" id="blok1-content">${blok1Html}</div><div class="tab-pane fade" id="blok2-content">${blok2Html}</div><div class="tab-pane fade" id="blok3-content">${formatKebutuhanData(data.kebutuhan_data)}</div><div class="tab-pane fade" id="blok4-content">${blok4Html}</div></div>`;
    }

    function formatKebutuhanData(kebutuhanArray) {
        if (!kebutuhanArray || kebutuhanArray.length === 0) {
            return '<p class="text-center fst-italic text-muted">Tidak ada kebutuhan data yang diisi (Blok III dilewati).</p>';
        }
        let html = '';
        kebutuhanArray.forEach((item, index) => {
            let tahunText = item.tahun_awal ? (item.tahun_akhir && item.tahun_akhir != item.tahun_awal ? `${item.tahun_awal} s/d ${item.tahun_akhir}` : item.tahun_awal) : (item.tahun_data || '-');
            let barisTambahanHtml = '';
            if (item.data_diperoleh && (item.data_diperoleh.toLowerCase().startsWith('ya'))) {
                let kualitasBintangHtml = '-';
                if (item.kualitas_data) {
                    kualitasBintangHtml = Array.from({length: 10}, (_, i) => `<span style="color: ${i < item.kualitas_data ? '#ffc107' : '#e0e0e0'};">&#9733;</span>`).join('');
                }
                barisTambahanHtml = `<tr class="table-info"><td colspan="2" class="fst-italic text-muted"><strong>Rincian Tambahan:</strong></td></tr><tr><th>Jenis Sumber</th><td>${item.jenis_publikasi||'-'}</td></tr><tr><th>Judul Publikasi</th><td>${item.judul_publikasi||'-'}</td></tr><tr><th>Tahun Publikasi</th><td>${item.tahun_publikasi||'-'}</td></tr><tr><th>Untuk Perencanaan?</th><td>${item.digunakan_perencanaan||'-'}</td></tr><tr><th>Kualitas Data</th><td>${kualitasBintangHtml}</td></tr>`;
            }
            html += `<div class="card mb-3"><div class="card-header bg-light"><strong>Kebutuhan Data Ke-${index + 1}</strong></div><div class="card-body p-0"><table class="table table-sm table-bordered mb-0"><tbody><tr><th style="width:30%;">Rincian</th><td>${item.rincian_data||'-'}</td></tr><tr><th>Wilayah</th><td>${item.wilayah_data||'-'}</td></tr><tr><th>Tahun</th><td>${tahunText}</td></tr><tr><th>Level</th><td>${item.level_data_lainnya||item.level_data||'-'}</td></tr><tr><th>Periode</th><td>${item.periode_data_lainnya||item.periode_data||'-'}</td></tr><tr><th>Diperoleh?</th><td>${item.data_diperoleh||'-'}</td></tr>${barisTambahanHtml}</tbody></table></div></div>`;
        });
        return html;
    }
</script>

<!-- <script>
document.addEventListener('DOMContentLoaded', function () {
  const forms = document.querySelectorAll('.run-bot-form');

  forms.forEach(form => {
    form.addEventListener('submit', async function () {
      const id = form.dataset.id;
      const statusUrl = form.dataset.statusUrl;
      const btn = form.querySelector('button[type="submit"]');
      const statusSpan = document.getElementById('status-' + id);
      const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

      // UI: memproses…
      const oldBtnHtml = btn.innerHTML;
      const oldStatusText = statusSpan ? statusSpan.textContent : '';
      btn.disabled = true;
      btn.innerHTML = '⏳ Memproses…';
      if (statusSpan) statusSpan.textContent = 'memproses…';

      // Kirim POST tombol via fetch (tanpa reload)
      try {
        const body = new FormData(form);
        await fetch(form.action, {
          method: 'POST',
          headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf },
          body
        });
      } catch (err) {
        btn.disabled = false;
        btn.innerHTML = oldBtnHtml;
        if (statusSpan) statusSpan.textContent = oldStatusText;
        alert('Gagal mengirim perintah bot: ' + (err?.message || err));
        return;
      }

      // Polling status sampai 'sukses' / 'gagal'
      let tries = 0, maxTries = 180; // ±6 menit (180 x 2s)
      const timer = setInterval(async () => {
        tries++;
        try {
          const r = await fetch(statusUrl, { headers: { 'Accept': 'application/json' }});
          if (r.ok) {
            const j = await r.json();
            if (j.status === 'sukses' || j.status === 'gagal') {
              if (statusSpan) statusSpan.textContent = j.status;
              btn.disabled = false;
              btn.innerHTML = oldBtnHtml;
              clearInterval(timer);
            }
          }
        } catch (e) {
          // abaikan sementara
        }

        if (tries >= maxTries) {
          clearInterval(timer);
          btn.disabled = false;
          btn.innerHTML = oldBtnHtml;
          if (statusSpan) statusSpan.textContent = oldStatusText;
          alert('Timeout menunggu hasil bot. Cek watcher, lalu coba klik ulang.');
        }
      }, 2000);
    });
  });
});
</script> -->

<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.run-bot-form').forEach(function (form) {
    form.addEventListener('submit', function () {
      // Nonaktifkan SEMUA tombol jalankan bot sampai halaman reload
      document.querySelectorAll('.run-bot-form button[type="submit"]').forEach(function (btn) {
        if (!btn.dataset.original) btn.dataset.original = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '⏳ Mengirim...';
      });
    });
  });
});
</script>


@endpush