<?php

namespace App\Observers;

use App\Models\Booking;
use App\Notifications\BookingConfirmationNotification;
use App\Notifications\BookingModificationNotification;

class BookingObserver
{
    public function created(Booking $booking): void
    {
        $booking->user->notify(new BookingConfirmationNotification($booking));
    }

    public function updated(Booking $booking): void
    {
        $booking->user->notify(new BookingModificationNotification($booking, 'update'));
    }

    public function deleted(Booking $booking): void
    {
        $booking->user->notify(new BookingModificationNotification($booking, 'delete'));
    }
}
