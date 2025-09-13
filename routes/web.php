<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use Revolution\Google\Sheets\Facades\Sheets;
use App\Http\Controllers\SkdController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute utama (/) sekarang akan memanggil method 'beranda' di KuesionerController.
Route::get('/', [KuesionerController::class, 'beranda'])->name('beranda');


// --- RUTE PUBLIK (ALUR BARU YANG LEBIH SEDERHANA) ---

// 1. Link statis untuk menampilkan formulir. INILAH LINK YANG AKAN ANDA BAGIKAN.
Route::get('/survei/isi', [KuesionerController::class, 'showForm'])->name('kuesioner.form');

// 2. Route untuk menyimpan data dari form.
Route::post('/survei/simpan', [KuesionerController::class, 'store'])->name('kuesioner.store');

// 3. Route untuk halaman "Terima Kasih" yang dikontrol oleh controller.
Route::get('/survei/selesai', [KuesionerController::class, 'showSuccess'])->name('kuesioner.success');

// --- RUTE PUBLIK ---
// ... (route publik lainnya) ...
Route::get('/survei/{respondent:unique_token}/edit', [KuesionerController::class, 'edit'])->name('kuesioner.edit');

// [TAMBAHAN BARU] Route untuk MENYIMPAN PERUBAHAN dari form edit
Route::put('/survei/{respondent:unique_token}', [KuesionerController::class, 'update'])->name('kuesioner.update');



// --- GRUP RUTE ADMIN ---
Route::middleware(['auth', 'can:view-admin-pages'])
    ->prefix('admin') // <- Semua URL akan diawali dengan /admin/...
    ->name('admin.')   // <- Semua nama rute akan diawali dengan admin.
    ->group(function () {
    
    Route::get('/introduce', [AdminController::class, 'showIntroduce'])->name('introduce');
    
    // Rute untuk Dashboard Monitoring
    Route::get('/monitoring', [AdminController::class, 'showMonitoring'])->name('monitoring');
    Route::post('/monitoring/sync', [AdminController::class, 'syncFromGoogleSheets'])->name('monitoring.sync');
    
    // Rute untuk Daftar Responden
    Route::get('/responden', [AdminController::class, 'indexResponden'])->name('responden');
    Route::get('/responden/{respondent}', [AdminController::class, 'showDetail'])->name('responden.detail');
    Route::delete('/responden/{respondent}', [AdminController::class, 'destroyResponden'])->name('responden.destroy');
    Route::post('/run-bot/{respondent}', [AdminController::class, 'triggerSkdBot'])->name('run_bot');
    Route::post('/run-all-bots', [AdminController::class, 'triggerAllBots'])->name('run_all_bots');

    

    // Rute untuk Manajemen Pengguna (dijaga oleh gate 'manage-users')
    Route::resource('users', UserController::class)->middleware('can:view-user-management');
});

Route::get('/admin/respondents/{respondent}/status', [AdminController::class, 'status'])
    ->name('admin.respondent.status');

Route::get('/tes-gsheet', function() {
    try {
        // 1. Buat instance dari Google Client secara manual
        $client = new \Google\Client();

        // 2. Arahkan secara EKSPLISIT ke file kredensial kita
        $credentialsPath = storage_path('app/google_credentials_dummyselaras.json');

        if (!file_exists($credentialsPath)) {
            return "FATAL: File kredensial tidak ditemukan di " . $credentialsPath;
        }

        $client->setAuthConfig($credentialsPath);

        // 3. Tambahkan "scope" (izin) yang kita butuhkan untuk Google Sheets
        $client->addScope('https://www.googleapis.com/auth/spreadsheets');

        // 4. Buat instance dari service Google Sheets
        $service = new \Google\Service\Sheets($client);

        // 5. Coba ambil data dari spreadsheet Anda
        $spreadsheetId = env('GSHEET_BUKU_TAMU_ID');
        // Kita ambil beberapa sel saja, misal dari Sheet1 kolom A baris 1 sampai kolom B baris 2
        $range = 'Sheet1!A1:B2'; 

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        // Jika berhasil, tampilkan hasilnya
        echo "<h1>Koneksi BERHASIL!</h1>";
        echo "<p>Data yang berhasil dibaca:</p>";
        dd($values);

    } catch (\Exception $e) {
        echo "<h1>Koneksi GAGAL.</h1>";
        echo "<p>Ini adalah error dari pustaka Google langsung, bukan dari package wrapper.</p>";
        // Kita 'dump' seluruh objek error untuk detail maksimal
        dd($e); 
    }
});
Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::post('/run-all-bots', [SkdController::class, 'runBot'])->name('admin.run_all_bots');
// routes/web.php

// Rute untuk tombol PER BARIS (yang kita gunakan)
// Route::post('/run-bot/{respondent}', [AdminController::class, 'triggerSkdBot'])->name('admin.run_bot');

// Rute untuk tombol MASSAL (yang tidak sengaja terpakai)
// Route::post('/run-all-bots', [AdminController::class, 'triggerAllBots'])->name('admin.run_all_bots');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
