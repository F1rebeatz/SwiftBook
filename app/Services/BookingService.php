<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Traits\RoomAvailability;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class BookingService
{
    use RoomAvailability;
    public function book(int $hotelId, array $requestData): Booking
    {
        try {
            $hotel = Hotel::findOrFail($hotelId);

            $startDate = Carbon::createFromFormat('Y-m-d', $requestData['started_at']);
            $endDate = Carbon::createFromFormat('Y-m-d', $requestData['finished_at']);

            if (!$this->isRoomAvailable($requestData['room_id'], $startDate, $endDate)) {
                throw new \Exception('The room is not available for the selected dates.');
            }

            $booking = Booking::create([
                'started_at' => $startDate,
                'finished_at' => $endDate,
                'hotel_id' => $hotel->id,
                'user_id' => auth()->user()->id,
                'room_id' => $requestData['room_id'],
                'price' => $requestData['price'],
                'days' => $requestData['days'],
            ]);

            return $booking;
        } catch (ModelNotFoundException $exception) {
            throw new \Exception('Hotel not found.');
        }
    }

}

