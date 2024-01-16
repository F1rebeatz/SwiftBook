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

            $startDate = Carbon::createFromFormat('Y-m-d', $requestData['started_at']);
            $endDate = Carbon::createFromFormat('Y-m-d', $requestData['finished_at']);

            if ($this->isRoomAvailable($requestData['room_id'], $startDate, $endDate)) {
                $booking = new Booking([
                    'started_at' => $startDate,
                    'finished_at' => $endDate,
                    'hotel_id' => $hotel->id,
                    'user_id' => auth()->user()->id,
                    'room_id' => $requestData['room_id'],
                    'price' => $requestData['price'],
                    'days' => $requestData['days'],
                ]);

                $booking->save();

                return $booking;
            } else {
                throw new \Exception('The room is not available for the selected dates.');
            }
        } catch (ModelNotFoundException $exception) {
            throw new \Exception('Hotel not found.');
        }
    }

    private function isRoomAvailable(int $roomId, Carbon $startDate, Carbon $endDate): bool
    {
        $existingBookings = Booking::where('room_id', $roomId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('started_at', '>=', $endDate)
                        ->orWhere('finished_at', '<=', $startDate);
                });
            })
            ->exists();

        return !$existingBookings;
    }



}
