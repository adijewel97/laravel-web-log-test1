<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class MIVSeqedulerCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sg:miv-clear-cache-cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear config, Route dan Cache cron';

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
     * @return mixed
     */
    public function handle()
    {
        //1 clear cache
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        $msg = 'Application route, config and cache cleared successfully.';
        $this->info($msg);  // atau echo 'Cron kita sudah jalan!';
        Log::info($msg);
    }
}
