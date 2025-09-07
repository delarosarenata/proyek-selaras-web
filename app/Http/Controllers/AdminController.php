<?php

namespace App\Http\Controllers;

use App\Jobs\RunSkdBot;
use Illuminate\Http\Request;
use App\Models\Respondent;
use Illuminate\Support\Facades\DB;

use App\Models\BukuTamu;
use App\Models\DataSkd;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;



class AdminController extends Controller
{
    /**
     * Menampilkan halaman briefing untuk petugas.
     */
    public function showIntroduce()
    {
        return view('admin.introduce');
    }

    /**
     * Menampilkan halaman dashboard.
     */
   // File: app/Http/Controllers/AdminController.php
    public function showDashboard()
    {
        $respondents = Respondent::all();
        $totalResponden = $respondents->count();

        // --- Data untuk Tab Segmentasi Konsumen ---

        // Menghitung data untuk pie chart (kolom tunggal)
        $jenisKelamin = $respondents->countBy('jenis_kelamin');
        $pendidikan = DB::table('respondents')
            ->join('pendidikans', 'respondents.pendidikan_id', '=', 'pendidikans.id')
            ->select('pendidikans.nama', DB::raw('count(*) as total'))
            ->groupBy('pendidikans.id', 'pendidikans.nama') // Group by ID juga untuk sorting
            ->orderBy('pendidikans.id', 'asc') // Urutkan berdasarkan ID
            ->get() // Ambil hasil yang sudah terurut
            ->pluck('total', 'nama'); // Ubah menjadi format yang benar

        $pekerjaan = DB::table('respondents')
            ->join('pekerjaans', 'respondents.pekerjaan_id', '=', 'pekerjaans.id')
            ->select('pekerjaans.nama', DB::raw('count(*) as total'))
            ->groupBy('pekerjaans.id', 'pekerjaans.nama')
            ->orderBy('pekerjaans.id', 'asc')
            ->get()
            ->pluck('total', 'nama');

        $instansi = DB::table('respondents')
            ->join('instansis', 'respondents.instansi_id', '=', 'instansis.id')
            ->select('instansis.nama', DB::raw('count(*) as total'))
            ->groupBy('instansis.id', 'instansis.nama')
            ->orderBy('instansis.id', 'asc')
            ->get()
            ->pluck('total', 'nama');

        $pemanfaatan = DB::table('respondents')
            ->join('pemanfaatans', 'respondents.pemanfaatan_id', '=', 'pemanfaatans.id')
            ->select('pemanfaatans.nama', DB::raw('count(*) as total'))
            ->groupBy('pemanfaatans.id', 'pemanfaatans.nama')
            ->orderBy('pemanfaatans.id', 'asc')
            ->get()
            ->pluck('total', 'nama');

        // Menghitung data untuk bar chart (kolom array/json)
        // $jenisLayanan = $respondents->flatMap(function ($respondent) {
        //     return $respondent->jenis_layanan ?? [];
        // })->countBy();

        $jenisLayanan = $respondents->flatMap(fn ($r) => $r->jenis_layanan ?? [])->countBy();

        // $saranaDigunakan = $respondents->flatMap(function ($respondent) {
        //     return $respondent->sarana_digunakan ?? [];
        // })->countBy();

        $saranaDigunakan = $respondents->flatMap(fn ($r) => $r->sarana_digunakan ?? [])->countBy();


        // --- Data untuk Tab Kebutuhan Data ---
        // $kebutuhanData = $respondents->flatMap(function ($respondent) {
        //     return $respondent->kebutuhan_data ?? [];
        // });
        $kebutuhanData = $respondents->flatMap(fn ($r) => $r->kebutuhan_data ?? []);

        $levelData = $kebutuhanData->countBy('level_data');
        $periodeData = $kebutuhanData->countBy('periode_data');
        $perolehanData = $kebutuhanData->countBy('data_diperoleh');


        // Kirim semua data yang sudah diolah ke view
        return view('admin.dashboard', compact(
            'totalResponden',
            'jenisKelamin',
            'pendidikan',
            'pekerjaan',
            'instansi',
            'pemanfaatan',
            'jenisLayanan',
            'saranaDigunakan',
            'levelData',
            'periodeData',
            'perolehanData'
        ));
    }

    public function showResponden()
    {
        // Mengambil data responden sekaligus relasi 'petugas' nya
        $respondents = Respondent::with('petugas')->latest()->get(); // <-- SEPERTI INI
        return view('admin.responden', compact('respondents'));
    }

    /**
     * Mengembalikan detail data responden sebagai JSON untuk pop-up.
     */
    public function showDetail(Respondent $respondent)
    {
        return response()->json($respondent);
    }

    /**
     * Menghapus data responden dari database.
     */
    public function destroyResponden(Respondent $respondent)
    {
        // Hapus data responden dari database
        $respondent->delete();

        // Kembalikan ke halaman daftar responden dengan pesan sukses
        return redirect()->route('admin.responden')
                         ->with('success', 'Data responden berhasil dihapus.');
    }

    // public function showMonitoring()
    // {
    //     // $respondents = Respondent::all()->keyBy('email');
    //     $bukuTamuAll = BukuTamu::latest('timestamp')->get();

    //     // Saring data buku tamu
    //     $bukuTamuFiltered = $bukuTamuAll->filter(function ($tamu) {
    //         // Ambil isi kolom 'Layanan yang Anda butuhkan'
    //         $layanan = $tamu->layanan_dibutuhkan ?? '';

    //         // Pecah menjadi array untuk diperiksa
    //         $layananArray = array_map('trim', explode(',', $layanan));

    //         // KONDISI: Jika array hanya berisi 1 item dan item itu adalah 'Lainnya'
    //         if (count($layananArray) === 1 && $layananArray[0] === 'Lainnya') {
    //             return false; // JANGAN TAMPILKAN baris ini
    //         }

    //         return true; // Tampilkan semua baris lainnya
    //     });

    //     $skdByEmail = DataSkd::whereNotNull('email')
    //     ->get(['email','tanggal_cacah','blok_4'])
    //     ->groupBy('email');

    //     $windowDays = null;

    //     // $monitoringData = $bukuTamuFiltered->map(function ($tamu) use ($skdByEmail) {
    //     //     $tanggalLayanan = Carbon::parse($tamu->timestamp);

    //     //     if (!empty($tamu->email) && isset($respondents[$tamu->email])) {
    //     //         $tamu->status_pengisian = 'Sudah Mengisi';
    //     //         $tanggalIsiSkd = Carbon::parse($respondents[$tamu->email]->created_at);
    //     //         $selisihHari = $tanggalLayanan->diffInDays($tanggalIsiSkd);
    //     //         $tamu->keterangan = "Mengisi setelah {$selisihHari} hari menerima layanan";

    //     //     } else {
    //     //         $tamu->status_pengisian = 'Belum Mengisi';
    //     //         $selisihHari = $tanggalLayanan->diffInDays(now());
    //     //         $tamu->keterangan = "Belum mengisi setelah {$selisihHari} hari menerima layanan";
    //     //     }
    //     //     return $tamu;
    //     // });

    //     // // Proses pemetaan sekarang menggunakan data yang sudah difilter
    //     // $monitoringData = $bukuTamuFiltered->map(function ($tamu) use ($respondents) {
    //     //     if (!empty($tamu->email) && isset($respondents[$tamu->email])) {
    //     //         $tamu->status_pengisian = 'Sudah Mengisi';
    //     //         $tamu->tanggal_pengisian_skd = $respondents[$tamu->email]->created_at;
    //     //     } else {
    //     //         $tamu->status_pengisian = 'Belum Mengisi';
    //     //         $tamu->tanggal_pengisian_skd = null;
    //     //     }
    //     //     return $tamu;
    //     // });

    //     $monitoringData = $bukuTamuFiltered->map(function ($tamu) use ($skdByEmail, $windowDays) {
    //         $tLayanan = \Carbon\Carbon::parse($tamu->timestamp);
    //         $status = 'Belum Mengisi';
    //         $tglSkd = null;

    //         if (!empty($tamu->email) && isset($skdByEmail[$tamu->email])) {
    //             $match = collect($skdByEmail[$tamu->email])->first(function ($r) use ($tLayanan, $windowDays) {
    //                 // pastikan “1” kebaca walau ada spasi/tipe beda
    //                 $blok4 = trim((string) $r->blok_4);
    //                 if ($blok4 !== '1') return false;

    //                 if (empty($r->tanggal_cacah)) return false;
    //                 $tCacah = \Carbon\Carbon::parse($r->tanggal_cacah);
    //                 return $tLayanan->diffInDays($tCacah) <= $windowDays;
    //             });

    //             if ($match) {
    //                 $status = 'Sudah Mengisi';
    //                 $tglSkd = $match->tanggal_cacah;
    //             }
    //         }

    //         $tamu->status_pengisian = $status;
    //         $tamu->tanggal_pengisian_skd = $tglSkd;

    //         // opsi: keterangan
    //         if ($status === 'Sudah Mengisi' && $tglSkd) {
    //             $selisih = $tLayanan->diffInDays(\Carbon\Carbon::parse($tglSkd));
    //             $tamu->keterangan = "Mengisi setelah {$selisih} hari menerima layanan";
    //         } else {
    //             $selisih = $tLayanan->diffInDays(now());
    //             $tamu->keterangan = "Belum mengisi setelah {$selisih} hari menerima layanan";
    //         }

    //         return $tamu;
    //     });


    //     $statistik = [
    //         'total_tamu' => $monitoringData->count(),
    //         'sudah_mengisi' => $monitoringData->where('status_pengisian', 'Sudah Mengisi')->count(),
    //         'belum_mengisi' => $monitoringData->where('status_pengisian', 'Belum Mengisi')->count()
    //     ];

    //     return view('admin.monitoring', compact('monitoringData', 'statistik'));
    // }

    // public function showMonitoring()
    // {
    //     // Ambil semua Buku Tamu terbaru
    //     $bukuTamuAll = BukuTamu::latest('timestamp')->get();

    //     // Filter yang kebutuhannya bukan "Lainnya" saja
    //     $bukuTamuFiltered = $bukuTamuAll->filter(function ($tamu) {
    //         $arr = array_map('trim', explode(',', $tamu->layanan_dibutuhkan ?? ''));
    //         return !(count($arr) === 1 && strtolower($arr[0]) === 'lainnya');
    //     });

    //     // Ambil SKD dan siapkan lookup by email yang sudah dinormalisasi
    //     $skdByEmail = DataSkd::whereNotNull('email')
    //         ->get(['id','email','tanggal_cacah','blok_4'])
    //         ->map(function ($r) {
    //             $r->email_norm = strtolower(trim(preg_replace('/\x{00A0}|\s+/u', '', (string)$r->email))); // buang spasi biasa & NBSP
    //             $r->blok4_norm = preg_replace('/\D+/', '', (string) $r->blok_4) ?: null; // “1 ”, “1.0”, dsb → “1”
    //             return $r;
    //         })
    //         ->groupBy('email_norm');
        
    //     // DIAGNOSTIC COUNTERS
    //     $diag = [
    //         'rows_bt'          => 0,
    //         'no_email_bt'      => 0,
    //         'no_skd_for_email' => 0,
    //         'blok4_not_1'      => 0,
    //         'skd_before_visit' => 0,
    //         'matched'          => 0,
    //     ];

    //     // Kalau mau batasi jarak hari, isi angka. Kalau mau TANPA batas, set null.
    //     $windowDays = null; // contoh: 7 kalau mau maksimal 7 hari setelah kunjungan

    //     // 
        
    //     $monitoringData = $bukuTamuFiltered->map(function ($tamu) use ($skdByEmail, &$diag) {
    //         $diag['rows_bt']++;

    //         $emailNorm = strtolower(trim(preg_replace('/\x{00A0}|\s+/u', '', (string) ($tamu->email ?? ''))));
    //         if ($emailNorm === '') {
    //             $diag['no_email_bt']++;
    //         }

    //         // anchor tanggal
    //         $tAnchor = !empty($tamu->tanggal_layanan)
    //             ? \Carbon\Carbon::parse($tamu->tanggal_layanan)
    //             : \Carbon\Carbon::parse($tamu->timestamp);

    //         $status = 'Belum Mengisi';
    //         $tglSkd = null;

    //         if ($emailNorm !== '' && isset($skdByEmail[$emailNorm])) {
    //             // kandidat: blok_4 == 1 & tanggal_cacah setelah/tepat anchor
    //             $cands = collect($skdByEmail[$emailNorm])->filter(function ($r) use ($tAnchor, &$diag) {
    //                 if ($r->blok4_norm !== '1') { $diag['blok4_not_1']++; return false; }
    //                 if (empty($r->tanggal_cacah)) { return false; }
    //                 $tC = \Carbon\Carbon::parse($r->tanggal_cacah);
    //                 if ($tC->lt($tAnchor)) { $diag['skd_before_visit']++; return false; }
    //                 return true;
    //             });

    //             $match = $cands
    //                 ->sortBy(fn($r) => $tAnchor->diffInSeconds(\Carbon\Carbon::parse($r->tanggal_cacah)))
    //                 ->first();

    //             if ($match) {
    //                 $status = 'Sudah Mengisi';
    //                 $tglSkd = $match->tanggal_cacah;
    //                 $diag['matched']++;
    //             } else {
    //                 // ada SKD buat email tsb tapi nggak ada yang qualify (semua before/ blok4≠1)
    //             }
    //         } else {
    //             if ($emailNorm !== '') $diag['no_skd_for_email']++;
    //         }

    //         $tamu->status_pengisian = $status;
    //         $tamu->tanggal_pengisian_skd = $tglSkd;

    //         if ($status === 'Sudah Mengisi' && $tglSkd) {
    //             $selisih = $tAnchor->diffInDays(\Carbon\Carbon::parse($tglSkd));
    //             $tamu->keterangan = "Mengisi setelah {$selisih} hari menerima layanan";
    //         } else {
    //             $selisih = $tAnchor->diffInDays(now());
    //             $tamu->keterangan = "Belum mengisi setelah {$selisih} hari menerima layanan";
    //         }

    //         return $tamu;
    //     });

    //     Log::info('MONITORING DIAG', $diag);


    //     $statistik = [
    //         'total_tamu'    => $monitoringData->count(),
    //         'sudah_mengisi' => $monitoringData->where('status_pengisian', 'Sudah Mengisi')->count(),
    //         'belum_mengisi' => $monitoringData->where('status_pengisian', 'Belum Mengisi')->count(),
    //     ];

    //     return view('admin.monitoring', compact('monitoringData', 'statistik'));
    // }

    // public function showMonitoring()
    // {
    //     $bukuTamuAll = BukuTamu::latest('timestamp')->get();

    //     // skip baris yang hanya "Lainnya"
    //     $bukuTamuFiltered = $bukuTamuAll->filter(function ($tamu) {
    //         $arr = array_map('trim', explode(',', $tamu->layanan_dibutuhkan ?? ''));
    //         return !(count($arr) === 1 && strtolower($arr[0]) === 'lainnya');
    //     });

    //     // siapkan SKD: normalize email & precompute "is checked" utk blok_4
    //     // $skdByEmail = DataSkd::whereNotNull('email')
    //     //     ->get(['id','email','tanggal_cacah','blok_4'])
    //     //     ->map(function ($r) {
    //     //         $r->email_norm = strtolower(trim(preg_replace('/\x{00A0}|\s+/u', '', (string)$r->email)));
    //     //         // di sini kamu tambahin / ganti normalisasi blok_4
    //     //         // (hapus versi yang pake regex centang kalau ada)
    //     //         $r->blok4_norm = trim((string)$r->blok_4);   // <-- PASTIIN ADA INI
    //     //         return $r;
    //     //     })
    //     //     ->groupBy('email_norm');

    //     // ==== 2) bikin index SKD berbasis email yang sudah dinormalisasi (array biasa) ====
    //     $skdIndex = [];
    //     foreach (DataSkd::whereNotNull('email')->get(['id','email','tanggal_cacah','blok_4']) as $r) {
    //         $key = $this->normEmail($r->email);
    //         if ($key === '') continue;
    //         // simpan minimal yang dibutuhkan
    //         $skdIndex[$key][] = (object)[
    //             'id'            => $r->id,
    //             'tanggal_cacah' => $r->tanggal_cacah, // sudah cast date di model
    //             'blok_4'        => (string) $r->blok_4,
    //         ];
    //     }


    //     // kalau mau batasi jarak hari, isi angka; kalau tanpa batas biarkan null
    //     $windowDays = null;

    //     $monitoringData = $bukuTamuFiltered->map(function ($tamu) use ($skdIndex, $windowDays) {
    //         $emailNorm = $this->normEmail($tamu->email ?? '');

    //         $tAnchor = !empty($tamu->tanggal_layanan)
    //             ? \Carbon\Carbon::parse($tamu->tanggal_layanan)->startOfDay()
    //             : \Carbon\Carbon::parse($tamu->timestamp)->startOfDay();

    //         $status = 'Belum Mengisi';
    //         $tglSkd = null;

    //         if ($emailNorm !== '' && isset($skdIndex[$emailNorm])) {
    //             // kandidat: BLOK 4 harus '1', tanggal ada, dan >= anchor
    //             $candidates = collect($skdIndex[$emailNorm])->filter(function ($r) use ($tAnchor) {
    //                 if (trim($r->blok_4) !== '1') return false;
    //                 if (empty($r->tanggal_cacah)) return false;
    //                 $tC = \Carbon\Carbon::parse($r->tanggal_cacah)->startOfDay();
    //                 return $tC->gte($tAnchor);
    //             });

    //             if (is_numeric($windowDays)) {
    //                 $limit = $tAnchor->copy()->addDays($windowDays);
    //                 $candidates = $candidates->filter(fn($r) => \Carbon\Carbon::parse($r->tanggal_cacah)->startOfDay()->lte($limit));
    //             }

    //             $match = $candidates
    //                 ->sortBy(fn($r) => $tAnchor->diffInSeconds(\Carbon\Carbon::parse($r->tanggal_cacah)))
    //                 ->first();

    //             if ($match) {
    //                 $status = 'Sudah Mengisi';
    //                 $tglSkd = $match->tanggal_cacah;
    //             }
    //         }

    //         $tamu->status_pengisian = $status;
    //         $tamu->tanggal_pengisian_skd = $tglSkd;

    //         if ($status === 'Sudah Mengisi' && $tglSkd) {
    //             $selisih = $tAnchor->diffInDays(\Carbon\Carbon::parse($tglSkd));
    //             $tamu->keterangan = "Mengisi setelah {$selisih} hari menerima layanan";
    //         } else {
    //             $selisih = $tAnchor->diffInDays(now());
    //             $tamu->keterangan = "Belum mengisi setelah {$selisih} hari menerima layanan";
    //         }

    //         return $tamu;
    //     });


    //     // (opsional) log ringkas buat cek cepat
    //     Log::info('MONITOR QUICK', [
    //         'bt_rows'   => $bukuTamuFiltered->count(),
    //         'skd_keys'  => count($skdIndex),
    //         'matched'   => $monitoringData->where('status_pengisian','Sudah Mengisi')->count(),
    //         'has_sumarwah' => isset($skdIndex[$this->normEmail('vivizakira@gmail.com')]),
    //     ]);


    //     $statistik = [
    //         'total_tamu'    => $monitoringData->count(),
    //         'sudah_mengisi' => $monitoringData->where('status_pengisian', 'Sudah Mengisi')->count(),
    //         'belum_mengisi' => $monitoringData->where('status_pengisian', 'Belum Mengisi')->count(),
    //     ];

    //     return view('admin.monitoring', compact('monitoringData', 'statistik'));
    // }

    // private function normEmail($s)
    // {
    //     // hapus spasi (termasuk NBSP), lowercase, trim
    //     $s = (string) $s;
    //     $s = preg_replace('/\x{00A0}|\s+/u', '', $s);
    //     return strtolower(trim($s));
    // }

    public function showMonitoring()
    {
        // =======================
        // ATURAN SEDERHANA
        // =======================
        $AFTER_ONLY  = true;  // true = hanya SKD setelah/tepat hari kunjungan
        $WINDOW_DAYS = null;  // isi angka (mis. 7) kalau mau batas jarak hari; biarkan null kalau tanpa batas

        // 1) Ambil Buku Tamu & skip "Lainnya"
        $bukuTamu = BukuTamu::latest('timestamp')->get()->filter(function ($t) {
            $arr = array_map('trim', explode(',', $t->layanan_dibutuhkan ?? ''));
            return !(count($arr) === 1 && strtolower($arr[0]) === 'lainnya');
        });

        // 2) Bikin index SKD: email -> daftar tanggal_cacah (hanya BLOK 4 = '1')
        $skdIndex = [];
        $skdRows = DataSkd::whereNotNull('email')->get(['email','tanggal_cacah','blok_4']);
        foreach ($skdRows as $r) {
            $email = $this->normEmail($r->email);
            if ($email === '') continue;
            if (trim((string)$r->blok_4) !== '1') continue;     // hanya yang benar2 "sudah isi"
            if (empty($r->tanggal_cacah)) continue;

            // simpan sebagai Carbon date (startOfDay biar fair)
            $skdIndex[$email][] = \Carbon\Carbon::parse($r->tanggal_cacah)->startOfDay();
        }

        // 3) Tentukan status per tamu
        $monitoringData = $bukuTamu->map(function ($t) use ($skdIndex, $AFTER_ONLY, $WINDOW_DAYS) {
            $email = $this->normEmail($t->email ?? '');
            $anchor = !empty($t->tanggal_layanan)
                ? \Carbon\Carbon::parse($t->tanggal_layanan)->startOfDay()
                : \Carbon\Carbon::parse($t->timestamp)->startOfDay();

            $status = 'Belum Mengisi';
            $tglSkd = null;

            if ($email !== '' && isset($skdIndex[$email])) {
                // filter kandidat sesuai aturan
                $cands = collect($skdIndex[$email])->filter(function ($d) use ($anchor, $AFTER_ONLY, $WINDOW_DAYS) {
                    if ($AFTER_ONLY && $d->lt($anchor)) return false;              // harus setelah/tepat hari H
                    if (is_numeric($WINDOW_DAYS)) {
                        return $d->lte($anchor->copy()->addDays($WINDOW_DAYS));    // dalam jendela hari
                    }
                    return true; // tanpa batas jarak
                })
                // ambil yang PALING DEKAT setelah anchor
                ->sortBy(fn($d) => $anchor->diffInSeconds($d));

                $match = $cands->first();
                if ($match) {
                    $status = 'Sudah Mengisi';
                    $tglSkd = $match->toDateString();
                }
            }

            // tulis kembali ke objek untuk view
            $t->status_pengisian = $status;
            $t->tanggal_pengisian_skd = $tglSkd;
            $t->keterangan = $status === 'Sudah Mengisi'
                ? "Mengisi setelah ".$anchor->diffInDays(\Carbon\Carbon::parse($tglSkd))." hari menerima layanan"
                : "Belum mengisi setelah ".$anchor->diffInDays(now())." hari menerima layanan";

            return $t;
        });

        $statistik = [
            'total_tamu'    => $monitoringData->count(),
            'sudah_mengisi' => $monitoringData->where('status_pengisian', 'Sudah Mengisi')->count(),
            'belum_mengisi' => $monitoringData->where('status_pengisian', 'Belum Mengisi')->count(),
        ];

        return view('admin.monitoring', compact('monitoringData', 'statistik'));
    }

    // normalisasi email (tetap dipakai)
    private function normEmail($s)
    {
        $s = (string)$s;
        $s = preg_replace('/\x{00A0}|\s+/u', '', $s); // buang spasi & NBSP
        return strtolower(trim($s));
    }




    public function syncFromGoogleSheets()
    {
        try {
            $client = new \Google\Client();
            $client->setAuthConfig(storage_path('app/google_credentials_dummyselaras.json'));
            $client->addScope('https://www.googleapis.com/auth/spreadsheets');
            $service = new \Google\Service\Sheets($client);
            
            // ==================================================================
            //            SINKRONISASI BUKU TAMU (FINAL)
            // ==================================================================
            $bukuTamuSheetId = config('services.google.buku_tamu_id');
            $bukuTamuSheetName = env('GSHEET_BUKU_TAMU_SHEET_NAME', 'Form Responses 1');
            $bukuTamuResponse = $service->spreadsheets_values->get($bukuTamuSheetId, $bukuTamuSheetName);
            $bukuTamuValues = $bukuTamuResponse->getValues();
            
            $bukuTamuCreatedCount = 0;
            if (!empty($bukuTamuValues)) {
                $bukuTamuHeader = array_map('trim', array_shift($bukuTamuValues));
                BukuTamu::truncate();
                $currentYear = now()->year;
                $timestampIndex = array_search('Timestamp', $bukuTamuHeader);

                $filteredValues = collect($bukuTamuValues)->filter(function ($row) use ($timestampIndex, $currentYear) {
                    if ($timestampIndex === false || !isset($row[$timestampIndex]) || empty($row[$timestampIndex])) return false;
                    try {
                        return Carbon::createFromFormat('d/m/Y H:i:s', $row[$timestampIndex])->year == $currentYear;
                    } catch (\Exception $e) { return false; }
                });

                foreach ($filteredValues as $row) {
                    $rowData = [];
                    foreach ($bukuTamuHeader as $index => $header) {
                        $rowData[$header] = $row[$index] ?? null;
                    }

                    $layanan = $rowData['Layanan yang Anda butuhkan'] ?? '';
                    $layananArray = array_map('trim', explode(',', $layanan));

                    // Jika array hanya berisi 1 item dan item itu adalah 'Lainnya',
                    // lewati baris ini dan jangan simpan ke database.
                    if (count($layananArray) === 1 && strtolower($layananArray[0]) === 'lainnya') {
                        continue; // Lanjut ke baris data berikutnya
                    }

                    
                    // Kode create Buku Tamu Anda sudah lengkap dan benar...
                    // BukuTamu::create([...]); 
                    BukuTamu::create([
                                'timestamp'           => !empty($rowData['Timestamp']) ? Carbon::createFromFormat('d/m/Y H:i:s', $rowData['Timestamp'])->toDateTimeString() : null,
                                'nama_lengkap'        => $rowData['Nama Lengkap'] ?? null,
                                'nomor_hp'            => $rowData['Nomor Ponsel/Whatsapp'] ?? null,
                                'email'               => $rowData['Email'] ?? null,
                                'jenis_kelamin'       => $rowData['Jenis Kelamin'] ?? null,
                                'tempat_lahir'        => $rowData['Tempat Lahir'] ?? null,
                                'tanggal_lahir'       => !empty($rowData['Tanggal Lahir']) ? Carbon::createFromFormat('d/m/Y', $rowData['Tanggal Lahir'])->toDateString() : null,
                                'profesi'             => $rowData['Profesi Pekerjaan'] ?? null,
                                'deskripsi_pekerjaan' => $rowData['Deskripsikan Pekerjaan Anda'] ?? null,
                                'pendidikan'          => $rowData['Pendidikan Terakhir'] ?? null,
                                'layanan_dibutuhkan'  => $rowData['Layanan yang Anda butuhkan'] ?? null,
                                'detail_layanan'      => $rowData['Tuliskan dengan jelas data / layanan yang diinginkan'] ?? null,
                                'pemanfaatan'         => $rowData['Pemanfaatan hasil kunjungan / data yang diperoleh'] ?? null,
                                'tanggal_layanan'     => !empty($rowData['Tanggal memperoleh layanan / data']) ? Carbon::createFromFormat('d/m/Y', $rowData['Tanggal memperoleh layanan / data'])->toDateString() : null,
                                'sarana'              => $rowData['Sarana yang digunakan untuk memperoleh layanan / data'] ?? null,
                            ]);
                    $bukuTamuCreatedCount++;
                }
            }

            // ==================================================================
            //             SINKRONISASI DATA SKD (FINAL & LENGKAP)
            // ==================================================================
            $dataSkdSheetId = config('services.google.data_skd_id');
            $dataSkdSheetName = env('GSHEET_DATA_SKD_SHEET_NAME', 'Sheet1');
            $dataSkdResponse = $service->spreadsheets_values->get($dataSkdSheetId, $dataSkdSheetName);
            $dataSkdValues = $dataSkdResponse->getValues();

            $dataSkdCreatedCount = 0;
            if (!empty($dataSkdValues)) {
                $dataSkdHeader = array_map('trim', array_shift($dataSkdValues));
                DataSkd::truncate();

                // $currentYear = now()->year;
                // $tanggalCacahIndex = array_search('Tanggal Cacah', $dataSkdHeader);
                
                // $filteredSkdValues = collect($dataSkdValues)->filter(function ($row) use ($tanggalCacahIndex, $currentYear) {
                //     if ($tanggalCacahIndex === false || !isset($row[$tanggalCacahIndex]) || empty($row[$tanggalCacahIndex])) return false;
                //     try {
                //         return Carbon::parse($row[$tanggalCacahIndex])->year == $currentYear;
                //     } catch (\Exception $e) { return false; }
                // });

                foreach ($dataSkdValues as $row) {

                    if (!collect($row)->contains(fn ($v) => trim((string)$v) !== '')) {
                        continue;
                    }

                    $rowData = [];
                    foreach ($dataSkdHeader as $index => $header) {
                        $rowData[$header] = $row[$index] ?? null;
                    }
                    
                    DataSkd::create([
                        'kategori'      => $rowData['Kategori'] ?? null,
                        'nama'          => $rowData['Nama'] ?? null,
                        'nomor_hp'      => $rowData['No. HP'] ?? null,
                        'email'         => $rowData['Email'] ?? null,
                        'nama_instansi' => $rowData['Nama Instansi'] ?? null,
                        'blok_1'        => $rowData['BLOK 1'] ?? null,
                        'blok_2'        => $rowData['BLOK 2'] ?? null,
                        'blok_3'        => $rowData['BLOK 3'] ?? null,
                        'blok_4'        => $rowData['BLOK 4'] ?? null,
                        // 'tanggal_cacah' => !empty($rowData['Tanggal Cacah']) ? Carbon::parse($rowData['Tanggal Cacah'])->toDateString() : null,
                        'tanggal_cacah' => $this->parseAnyDate($rowData['Tanggal Cacah'] ?? null),
                    ]);
                    $dataSkdCreatedCount++;
                }
            }
            
            $pesanSukses = "Sinkronisasi selesai! | Buku Tamu: {$bukuTamuCreatedCount} data (tahun ini) berhasil diimpor. | Data SKD: {$dataSkdCreatedCount} data (tahun ini) berhasil diimpor.";
            return redirect()->route('admin.monitoring')->with('success', $pesanSukses);

        } catch (\Exception $e) {
            Log::error('Gagal sinkronisasi dari Google Sheet: ' . $e->getMessage());
            return redirect()->route('admin.monitoring')->with('error', 'Terjadi kesalahan. Cek log untuk detail: ' . substr($e->getMessage(), 0, 200) . '...');
        }
    }

    private function clean($v)
    {
        if (is_string($v)) $v = trim($v);
        return ($v === '' ? null : $v);
    }

    private function parseAnyDate($value)
    {
        if (empty($value)) return null;
        $value = trim($value);

        $formats = [
            'd/m/Y H:i:s', 'd/m/Y', 'd-m-Y', 'Y-m-d', 'm/d/Y', 'Y/m/d', 'd M Y',
        ];

        foreach ($formats as $fmt) {
            try {
                return \Carbon\Carbon::createFromFormat($fmt, $value)->toDateString();
            } catch (\Throwable $e) {}
        }

        // fallback Carbon::parse (buat format bebas / serial date yang bisa dikenali)
        try {
            return \Carbon\Carbon::parse($value)->toDateString();
        } catch (\Throwable $e) {
            return null; // kalau tetap gagal, biarkan null tapi barisnya tetap masuk
        }
    }


    public function indexResponden()
    {
        $respondents = Respondent::latest()->get(); // Ambil semua data responden, urutkan dari terbaru
        return view('admin.responden', compact('respondents'));
    }

    // Method untuk tombol per baris
    public function triggerSkdBot(Respondent $respondent)
    {
        if ($respondent->status === 'sukses') {
            return back()->with('error', 'Data ini sudah berstatus SUKSES dan tidak bisa dientri ulang.');
        }

        // Langsung kirim pekerjaan ke antrian tanpa mengubah status
        RunSkdBot::dispatch($respondent);

        return back()->with('success', 'Perintah untuk menjalankan bot telah dikirim!');
    }

    // Method untuk tombol massal
    public function triggerAllBots()
    {
        $respondentsToProcess = Respondent::whereIn('status', ['pending', 'gagal'])->get();

        if ($respondentsToProcess->isEmpty()) {
            return back()->with('info', 'Tidak ada data pending atau gagal yang perlu dijalankan.');
        }

        foreach ($respondentsToProcess as $respondent) {
            // Langsung kirim pekerjaan ke antrian tanpa mengubah status
            RunSkdBot::dispatch($respondent);
        }
        
        $count = $respondentsToProcess->count();
        return back()->with('success', "Berhasil! {$count} pekerjaan telah dikirim ke antrian untuk diproses oleh bot.");
    }
}