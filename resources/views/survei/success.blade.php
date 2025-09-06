@extends('layouts.app-no-header')

@section('title', 'Survei Berhasil Dikirim')

@section('content')
<div class="container text-center" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card col-md-8 mx-auto shadow-sm">
        <div class="card-body p-5">
            <h1 class="mb-3" style="font-size: 4rem;">🎉</h1>
            <h2 class="card-title mb-3">Terima Kasih!</h2>
            <p class="text-secondary fs-5">
                Partisipasi Anda sangat berarti. Jawaban Anda telah berhasil kami terima.
            </p>
            <a href="{{ route('kuesioner.form') }}" class="btn btn-primary mt-4">Isi Survei Lagi</a>
        </div>
    </div>
</div>
@endsection

{{-- LETAKKAN BLOK SCRIPT DI SINI, DI PALING BAWAH --}}
@section('scripts')
<script>
    // 1. Ganti URL di histori browser saat ini dengan URL formulir baru.
    // Ini adalah "jebakan" utama. Secara teknis, browser sekarang berpikir
    // bahwa halaman saat ini adalah halaman formulir baru.
    window.history.replaceState(null, null, "{{ route('kuesioner.form') }}");

    // 2. Tangani jika pengguna menekan tombol Back.
    window.addEventListener('popstate', function () {
        // Jika 'Back' ditekan, jangan lakukan apa-apa, cukup pastikan
        // pengguna tetap berada di halaman formulir baru.
        window.location.replace("{{ route('kuesioner.form') }}");
    });
</script>
@endsection