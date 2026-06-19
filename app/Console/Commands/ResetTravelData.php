<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetTravelData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-travel-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset travel data (destinations, packages, bookings, payments)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('payments')->truncate();
        DB::table('booking_items')->truncate();
        DB::table('bookings')->truncate();
        DB::table('travel_packages')->truncate();
        DB::table('destinations')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Travel data reset successfully');
    }
}
