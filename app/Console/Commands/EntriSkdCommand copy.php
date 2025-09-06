<?php

namespace App\Console\Commands;

use App\Models\Respondent;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class EntriSkdCommand extends Command
{
    // 1. Ubah "signature" agar bisa menerima ID
    protected $signature = 'skd:entri {respondentId}';
    protected $description = 'Menjalankan bot untuk satu responden spesifik';

    public function handle()
    {
        // 2. Ambil ID yang dikirim oleh Controller
        $respondentId = $this->argument('respondentId');
        $respondent = Respondent::find($respondentId);

        if (!$respondent) {
            $this->error("Responden dengan ID {$respondentId} tidak ditemukan.");
            return 1; // Keluar dengan status error
        }

        $this->info("Memulai proses untuk responden ID: {$respondent->id}");

        // 3. Ubah semua data responden menjadi satu teks panjang (JSON)
        $dataJson = $respondent->toJson();

        // 4. Siapkan path lengkap untuk menjalankan bot
        $nodePath = 'C:\laragon\bin\nodejs\node-v18\node.exe'; // <-- Sesuaikan versi
        $botScriptPath = 'C:\laragon\www\automation\skd-entri.js';

        // 5. Jalankan bot sambil "memberikan" data JSON sebagai bekal
        $process = new Process([$nodePath, $botScriptPath, $dataJson]);
        $process->setTimeout(3600);
        $process->run();

        // 6. Setelah bot selesai, Laravel yang akan update status
        if (!$process->isSuccessful()) {
            $respondent->update(['status' => 'gagal']);
            $this->error('Proses entri GAGAL: ' . $process->getErrorOutput());
        } else {
            // Jika bot tidak error, kita anggap sukses
            $respondent->update(['status' => 'sukses']);
            $this->info('Proses entri SELESAI: ' . $process->getOutput());
        }
        return 0; // Keluar dengan status sukses
    }
}