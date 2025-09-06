<?php

namespace App\Console\Commands;

use App\Models\Respondent;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class EntriSkdCommand extends Command
{
    protected $signature = 'skd:entri {respondentId}'; // Terima ID sebagai argumen
    protected $description = 'Menjalankan bot untuk satu responden spesifik';

    public function handle()
    {
        $respondentId = $this->argument('respondentId');
        $respondent = Respondent::find($respondentId);

        if (!$respondent) {
            $this->error("Responden dengan ID {$respondentId} tidak ditemukan.");
            return 1;
        }

        $this->info("Memulai proses untuk responden ID: {$respondent->id}");
        // $respondent->update(['status' => 'processing']);

        // Ubah semua data menjadi satu string JSON untuk dikirim ke bot
        $dataJson = $respondent->toJson();

        $nodePath = 'C:\laragon\bin\nodejs\node-v18\node.exe'; // Sesuaikan versi
        $botScriptPath = 'C:\laragon\www\automation\skd-entri.js';

        // Kirim data JSON sebagai argumen
        $process = new Process([$nodePath, $botScriptPath, $dataJson]);
        $process->setTimeout(3600);
        $process->run();

        if (!$process->isSuccessful()) {
            $respondent->update(['status' => 'gagal']);
            $this->error('Proses entri GAGAL: ' . $process->getErrorOutput());
        } else {
            $respondent->update(['status' => 'sukses']);
            $this->info('Proses entri SELESAI: ' . $process->getOutput());
        }
        return 0;
    }
}