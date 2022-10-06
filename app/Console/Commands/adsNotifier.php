<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Ad;
use Carbon\Carbon;

class adsNotifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:adsNotifier';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $ads = Ad::whereDate("start_at",$tomorrow)->get();
        foreach ($ads as $ad) {
            $user = $ad->user;
            # write the code to notify user for the ads comming tomorrow...
        }
        return true;
    }
}
