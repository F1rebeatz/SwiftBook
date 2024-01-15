<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Hotel;
use Carbon\Carbon;

class BookingService
{
    public function book(int $hotelId, array $requestData): array
    {
        $hotel = Hotel::find($hotelId);

        if (!$hotel) {
            return ['error' => 'Hotel not found.'];
        }

        $booking = new Booking([
            'started_at' => Carbon::createFromFormat('Y-m-d', $requestData['started_at']),
            'finished_at' => Carbon::createFromFormat('Y-m-d', $requestData['finished_at']),
            'hotel_id' => $hotel->id,
            'user_id' => auth()->user()->id,
            'room_id' => $requestData['room_id'],
            'price' => $requestData['price'],
            'days' => $requestData['days'],
        ]);

        $booking->save();

        return ['success' => 'Booking created successfully.'];
    }
}
