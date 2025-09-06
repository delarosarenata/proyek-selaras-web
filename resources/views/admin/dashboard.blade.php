@extends('layouts.app')

@section('title', 'Dashboard SELARAS')

@section('content')
<div class="container mt-5">
    
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Responden</h5>
                    <p class="card-text fs-1 fw-bold">{{ $totalResponden }}</p>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs mt-4" id="dashboardTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="segmentasi-tab" data-bs-toggle="tab" data-bs-target="#segmentasi" type="button">Segmentasi Konsumen</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="kebutuhan-tab" data-bs-toggle="tab" data-bs-target="#kebutuhan" type="button">Kebutuhan Data</button>
        </li>
    </ul>

    <div class="tab-content" id="dashboardTabContent">
        <div class="tab-pane fade show active" id="segmentasi" role="tabpanel">
            <div class="row mt-4">
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="jenisKelaminChart"></canvas></div></div></div>
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="pendidikanChart"></canvas></div></div></div>
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="pekerjaanChart"></canvas></div></div></div>
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="instansiChart"></canvas></div></div></div>
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="pemanfaatanChart"></canvas></div></div></div>
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="jenisLayananChart"></canvas></div></div></div>
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="saranaChart"></canvas></div></div></div>
            </div>
        </div>
        <div class="tab-pane fade" id="kebutuhan" role="tabpanel">
            <div class="row mt-4">
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="levelDataChart"></canvas></div></div></div>
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="periodeDataChart"></canvas></div></div></div>
                <div class="col-md-4 mb-4"><div class="card"><div class="card-body"><canvas id="perolehanDataChart"></canvas></div></div></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Helper untuk membuat chart ---
    const createPieChart = (canvasId, chartData, title) => {
        const ctx = document.getElementById(canvasId).getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: Object.keys(chartData),
                datasets: [{
                    label: 'Jumlah',
                    data: Object.values(chartData),
                    backgroundColor: ['#4A90E2', '#50E3C2', '#F5A623', '#F8E71C', '#BD10E0', '#B8E986', '#7ED321'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: title, font: { size: 16 } },
                    // --- AWAL BAGIAN BARU ---
                    // Konfigurasi Tooltip (saat mouse hover)
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw;
                                const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? (value / total * 100).toFixed(1) : 0;
                                return `Jumlah: ${value} (${percentage}%)`;
                            }
                        }
                    },
                    // Konfigurasi Datalabels (teks di atas chart)
                    datalabels: {
                        formatter: (value, context) => {
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? (value / total * 100) : 0;
                            // Hanya tampilkan persentase jika lebih dari 5% agar tidak terlalu ramai
                            if (percentage < 5) {
                                return '';
                            }
                            return percentage.toFixed(1) + '%';
                        },
                        color: '#fff', // Warna teks label
                        font: {
                            weight: 'bold'
                        }
                    }
                    // --- AKHIR BAGIAN BARU ---
                }
            }
        });
    };
    
    const createBarChart = (canvasId, chartData, title) => {
        const ctx = document.getElementById(canvasId).getContext('2d');
        const sortedData = Object.entries(chartData).sort(([,a],[,b]) => b-a);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: sortedData.map(item => item[0]),
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: sortedData.map(item => item[1]),
                    backgroundColor: '#4A90E2',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: title, font: { size: 16 } },
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    };

    // --- Menggambar Chart ---
    
    // Tab 1
    createPieChart('jenisKelaminChart', @json($jenisKelamin), 'Jenis Kelamin');
    createPieChart('pendidikanChart', @json($pendidikan), 'Pendidikan');
    createPieChart('pekerjaanChart', @json($pekerjaan), 'Pekerjaan Utama');
    createPieChart('instansiChart', @json($instansi), 'Instansi');
    createPieChart('pemanfaatanChart', @json($pemanfaatan), 'Pemanfaatan Data');
    createPieChart('jenisLayananChart', @json($jenisLayanan), 'Jenis Layanan');
    createPieChart('saranaChart', @json($saranaDigunakan), 'Fasilitas Kunjungan');

    // Tab 2
    createPieChart('levelDataChart', @json($levelData), 'Kebutuhan Berdasarkan Level Data');
    createPieChart('periodeDataChart', @json($periodeData), 'Kebutuhan Berdasarkan Periode Data');
    createPieChart('perolehanDataChart', @json($perolehanData), 'Status Perolehan Data');
});
</script>
@endpush