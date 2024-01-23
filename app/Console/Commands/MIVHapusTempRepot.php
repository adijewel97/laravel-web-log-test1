<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MIVHapusTempRepot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sg:miv-deletefile-tempreport-cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus file temp repot di storage/app/public/report App Laravel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Mendapatkan waktu saat ini
        $currentDateTime = Carbon::now();

        // Mendapatkan daftar file dalam direktori storage/app/public/report
        $directory = 'public/report/';
        $files = Storage::files($directory);

        // Menyimpan file-file yang memiliki create date lebih dari 1 jam yang lalu
        $filesModifiedMoreThanOneHourAgo = [];

        foreach ($files as $file) {
            // Mendapatkan waktu terakhir file diubah
            $lastModifiedTime = Carbon::createFromTimestamp(Storage::lastModified($file));

            // Memeriksa apakah file diubah lebih dari 1 jam yang lalu
            if ($lastModifiedTime->diffInHours($currentDateTime) > 1) {
                // Menghapus file dan menyimpan status penghapusan
                $isDeleted = Storage::delete($file);

                // Menyimpan informasi tentang penghapusan
                $filesModifiedMoreThanOneHourAgo[] = [
                    'file' => $file,
                    'last_modified' => $lastModifiedTime->toDateTimeString(),
                    'deleted' => $isDeleted ? 'Berhasil dihapus' : 'Gagal dihapus'
                ];
            }
        }

        $msg = 'Menghapus file temp repot di storage/app/public/report App Laravel';
        $this->info($msg);  // atau echo 'Cron kita sudah jalan!';
        Log::info($msg);
        Log::info($filesModifiedMoreThanOneHourAgo);
    }
}
