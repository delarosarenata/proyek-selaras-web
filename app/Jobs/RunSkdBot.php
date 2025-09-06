<?php

namespace App\Jobs;

use App\Models\Respondent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;

class RunSkdBot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $respondent;

    public function __construct(Respondent $respondent)
    {
        $this->respondent = $respondent;
    }

    public function handle(): void
    {
        Log::info("Memulai job RunSkdBot untuk responden ID: {$this->respondent->id}");

        // Tentukan path absolut ke folder bot Anda
        $botDirectory = 'C:\laragon\www\automation'; // GANTI JIKA PERLU

        // Perintah untuk menjalankan bot, dengan mengirim ID responden sebagai argumen
        $process = new Process(['C:\laragon\bin\nodejs\node-v18\node.exe', 'skd-entri.js', $this->respondent->id], $botDirectory);
        $process->setTimeout(3600); // Set timeout menjadi 1 jam
        $process->run();

        if (!$process->isSuccessful()) {
            // Jika bot gagal, kembalikan status ke 'gagal' agar bisa dicoba lagi
            $this->respondent->update(['status' => 'gagal']);
            Log::error("Job RunSkdBot GAGAL untuk ID {$this->respondent->id}: " . $process->getErrorOutput());
        } else {
            // Jika bot berhasil, status 'sukses' sudah di-update oleh bot itu sendiri.
            Log::info("Job RunSkdBot SELESAI untuk ID {$this->respondent->id}: " . $process->getOutput());
        }
    }
}