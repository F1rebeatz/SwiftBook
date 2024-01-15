<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class BookingService
{
    public function book(int $hotelId, array $requestData): Booking
    {
        try {
            $hotel = Hotel::findOrFail($hotelId);

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

            return $booking;
        } catch (ModelNotFoundException $exception) {
            throw new \Exception('Hotel not found.');
        }
    }
}
