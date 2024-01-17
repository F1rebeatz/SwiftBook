<?php

namespace App\Models\Traits;

use App\Models\Booking;
use Carbon\Carbon;

trait RoomAvailability
{
    private function isRoomAvailable(int $roomId, Carbon $startDate, Carbon $endDate): bool
    {
        return !Booking::where('room_id', $roomId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('started_at', '<', $endDate)->where('finished_at', '>', $startDate);
            })->exists();
    }
}
