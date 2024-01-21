<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;


class BookingService
{
    public function book(int $hotelId, array $requestData): Booking|RedirectResponse
    {
        try {
            $startDate = Carbon::createFromFormat('Y-m-d', $requestData['started_at']);
            $endDate = Carbon::createFromFormat('Y-m-d', $requestData['finished_at']);

            if ($startDate === false || $endDate === false) {
                throw new \Exception('Invalid date format.');
            }

            if ($endDate->diffInDays($startDate) <= 0) {
                throw new \Exception('Invalid booking duration.');
            }

            $hotel = Hotel::findOrFail($hotelId);

            if (!$this->isRoomAvailable($requestData['room_id'], $startDate, $endDate)) {
                throw new \Exception('The room is not available for the selected dates.');
            }

            return Booking::create([
                'started_at' => $startDate,
                'finished_at' => $endDate,
                'hotel_id' => $hotel->id,
                'user_id' => auth()->user()->id,
                'room_id' => $requestData['room_id'],
                'price' => $requestData['price'],
                'days' => $requestData['days'],
            ]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    private function isRoomAvailable(int $roomId, Carbon $startDate, Carbon $endDate): bool
    {
        return !Booking::where('room_id', $roomId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('started_at', '<=', $endDate)->where('finished_at', '>=', $startDate);
            })->exists();
    }

}

