<?php

namespace App\Http\Controllers;

use App\Models\Respondent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SkdController extends Controller
{
    // public function runBot(Request $request, Respondent $respondent) // Terima $respondent
    // {
    //     // Panggil Artisan command dengan ID
    //     Artisan::call('skd:entri', ['respondentId' => $respondent->id]);
    //     $output = Artisan::output();
    //     return back()->with('success', "Proses bot selesai. Hasil: <pre>{$output}</pre>");
    // }

    // public function runBot(Respondent $respondent)
    // {
    //     // -> Kalau nama kolommu 'status_entri', ganti 'status' jadi 'status_entri'
    //     $respondent->update(['status' => 'pending']);

    //     return back()->with('success', 'Masuk antrean lokal. Pastikan Bot Desktop (watcher) sedang berjalan.');
    // }

    public function runBot(Respondent $respondent)
    {
        // Tandai baris ini diminta dijalankan oleh bot
        $respondent->update(['run_request' => now()]);

        // (Opsional) Kalau kamu tetap ingin menandai status agar terlihat "menunggu", boleh tambahkan:
        // $respondent->update(['status' => 'pending']); 
        // atau kalau kolommu 'status_entri', pakai itu.

        return back()->with('success', 'Permintaan bot dikirim. Watcher akan memproses ID ini.');
    }


}