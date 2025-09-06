    @extends('layouts.app')

    @section('title', 'Daftar Responden')

    @section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Responden Survei</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>Nama Instansi</th>
                                <th>Tgl & Jam Cacah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($respondents as $index => $respondent)
                            <tr>
                                <td>{{ $respondents->firstItem() + $index }}</td>
                                <td>{{ $respondent->nama }}</td>
                                <td>{{ $respondent->no_hp }}</td>
                                <td>{{ $respondent->email }}</td>
                                <td>{{ $respondent->nama_instansi }}</td>
                                <td>{{ $respondent->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="lihatDetail('{{ route('admin.responden.detail', $respondent) }}')">
                                        Detail
                                    </button>

                                    <button class="btn btn-secondary btn-sm" onclick="copyLink('{{ route('kuesioner.edit', $respondent) }}')">
                                        Copy Link
                                    </button>

                                    <form action="{{ route('admin.responden.destroy', $respondent) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data responden.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $respondents->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Jawaban Responden</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="detailContent">
                        <p class="text-center">Memuat data...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
        const detailContent = document.getElementById('detailContent');

        function lihatDetail(url) {
            detailContent.innerHTML = '<p class="text-center">Memuat data...</p>';
            detailModal.show();
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    populateModal(data);
                })
                .catch(error => {
                    detailContent.innerHTML = '<p class="text-center text-danger">Gagal memuat data.</p>';
                    console.error('Error:', error);
                });
        }

        function copyLink(link) {
            navigator.clipboard.writeText(link).then(() => {
                alert('Link edit berhasil disalin ke clipboard!');
            });
        }

        function formatLainnya(value, lainnyaValue) {
            return value.toLowerCase() === 'lainnya' ? `Lainnya (${lainnyaValue || 'tidak diisi'})` : value;
        }

        function populateModal(data) {
            let contentHtml = `
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" id="blok1-tab" data-bs-toggle="tab" data-bs-target="#blok1" type="button">Blok I</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="blok2-tab" data-bs-toggle="tab" data-bs-target="#blok2" type="button">Blok II</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="blok3-tab" data-bs-toggle="tab" data-bs-target="#blok3" type="button">Blok III</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="blok4-tab" data-bs-toggle="tab" data-bs-target="#blok4" type="button">Blok IV</button></li>
            </ul>
            <div class="tab-content p-3 border-start border-end border-bottom" id="myTabContent">
                <div class="tab-pane fade show active" id="blok1" role="tabpanel">
                    <dl class="row">
                        <dt class="col-sm-4">Nama</dt><dd class="col-sm-8">${data.nama}</dd>
                        <dt class="col-sm-4">Email</dt><dd class="col-sm-8">${data.email}</dd>
                        <dt class="col-sm-4">No. HP</dt><dd class="col-sm-8">${data.no_hp}</dd>
                        <dt class="col-sm-4">Jenis Kelamin</dt><dd class="col-sm-8">${data.jenis_kelamin}</dd>
                        <dt class="col-sm-4">Pendidikan</dt><dd class="col-sm-8">${data.pendidikan_id}</dd>
                        <dt class="col-sm-4">Pekerjaan</dt><dd class="col-sm-8">${formatLainnya(data.pekerjaan_id, data.pekerjaan_lainnya)}</dd>
                        <dt class="col-sm-4">Nama Instansi</dt><dd class="col-sm-8">${data.nama_instansi}</dd>
                    </dl>
                </div>
                <div class="tab-pane fade" id="blok2" role="tabpanel">
                    </div>
                <div class="tab-pane fade" id="blok3" role="tabpanel">
                    </div>
                <div class="tab-pane fade" id="blok4" role="tabpanel">
                    <h6>Catatan:</h6>
                    <p class="text-muted">${data.catatan || '<em>Tidak ada catatan.</em>'}</p>
                </div>
            </div>
        `;
            detailContent.innerHTML = contentHtml;
        }
    </script>
    @endsection