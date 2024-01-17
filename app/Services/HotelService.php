<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Traits\RoomAvailability;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class HotelService
{
    use RoomAvailability;
    public function display(int $id, array $queryParams): array
    {
        $hotel = Hotel::find($id);
        $startDate = $queryParams['start_date'] ?? Carbon::now()->format('Y-m-d');
        $endDate = $queryParams['end_date'] ?? Carbon::now()->addDay()->format('Y-m-d');

        $rooms = $this->getAvailableRooms($hotel, $startDate, $endDate);

        $sortBy = $queryParams['sort_by'] ?? null;

        if ($sortBy === 'price_asc') {
            $rooms = $rooms->sortBy('price');
        } elseif ($sortBy === 'price_desc') {
            $rooms = $rooms->sortByDesc('price');
        }

        foreach ($rooms as $room) {
            $room->total_price = $room->price * $room->calculateDays($startDate, $endDate);
            $room->total_days = $room->calculateDays($startDate, $endDate);
        }

        return compact('hotel', 'rooms', 'startDate', 'endDate', 'sortBy');
    }

    private function getAvailableRooms(Hotel $hotel, string $startDate, string $endDate): Collection
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
        return $hotel->rooms->load('facilities')->filter(function ($room) use ($startDate, $endDate) {
            return $this->isRoomAvailable($room->id, $startDate, $endDate);
        });
    }
}


