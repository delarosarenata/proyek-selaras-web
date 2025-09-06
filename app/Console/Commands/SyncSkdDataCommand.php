<?php

namespace App\Console\Commands;

use App\Models\DataSkd; 
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Carbon\Carbon;

class SyncSkdDataCommand extends Command
{
    protected $signature = 'skd:sync-monitoring';
    protected $description = 'Menjalankan bot untuk sinkronisasi data SKD dari web asli';

    public function handle()
    {
        $this->info('Memulai bot monitoring SKD...');

        $nodePath = 'C:\laragon\bin\nodejs\node-v18\node.exe'; 
        $botScriptPath = 'C:\laragon\www\automation\skd-monitoring.js';

        $process = new Process([$nodePath, $botScriptPath]);
        $process->setTimeout(3600);
        $process->run();

        if (!$process->isSuccessful()) {
            $this->error('Bot monitoring GAGAL.');
            $this->error($process->getErrorOutput());
            return 1;
        }

        $this->info('Bot selesai. Memproses data...');
        $scrapedData = json_decode($process->getOutput(), true);

        if (is_null($scrapedData)) {
            $this->error('Gagal membaca data JSON dari bot.');
            return 1;
        }

        // Hapus data lama dan simpan data baru
        DataSkd::truncate(); 
        foreach ($scrapedData as $data) {
            DataSkd::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'tanggal_cacah' => Carbon::parse($data['tanggal_cacah'])->toDateString(),
            ]);
        }

        $this->info(count($scrapedData) . ' data SKD berhasil disinkronkan ke database.');
        return 0;
    }
}