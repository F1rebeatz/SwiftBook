<?php

namespace App\Console\Commands;

use App\Events\UpcomingArrival;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendUpcomingArrivalNotifications extends Command
{
    protected $signature = 'notifications:upcoming-arrival';

    protected $description = 'Send upcoming arrival notifications to users';

    public function handle(): void
    {
        $upcomingBookings = Booking::whereDate('started_at', '>=', Carbon::now())
            ->whereDate('started_at', '<=', Carbon::now()->addDays(3))
            ->get();

        if ($upcomingBookings->isNotEmpty()) {
            foreach ($upcomingBookings as $booking) {
                event(new UpcomingArrival($booking));
            }
        }

        $this->info('Upcoming arrival notifications sent successfully.');
    }
}
