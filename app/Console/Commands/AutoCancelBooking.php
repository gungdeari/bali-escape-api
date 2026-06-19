<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BookingService;

class AutoCancelBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel all bookings that have passed their expiry date';

    /**
     * Execute the console command.
     */
    public function handle(BookingService $bookingService)
    {
        $count = $bookingService->autoCancelExpired();
        $this->info("Cancelled {$count} expired bookings.");
        return Command::SUCCESS; 
    }
}
