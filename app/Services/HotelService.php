<?php

namespace App\Services;

use App\Models\Hotel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class HotelService
{
    public function searchAndFilter(?string $searchQuery, array $selectedFacilities): LengthAwarePaginator
    {
        $query = Hotel::with('facilities');

        $this->applySearchQuery($query, $searchQuery);
        $this->applyFacilitiesFilter($query, $selectedFacilities);

        return $query->paginate(10);
    }

    protected function applySearchQuery(Builder $query, ?string $searchQuery): void
    {
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%$searchQuery%")
                    ->orWhere('address', 'like', "%$searchQuery%");
            });
        }
    }

    protected function applyFacilitiesFilter(Builder $query, array $selectedFacilities): void
    {
        if (!empty($selectedFacilities)) {
            $query->whereHas('facilities', function ($q) use ($selectedFacilities) {
                $q->whereIn('facility_id', $selectedFacilities);
            }, '=', count($selectedFacilities));
        }
    }

    public function display(int $id, array $queryParams): array
    {
        $hotel = Hotel::find($id);
        $rooms = $hotel->rooms;

        $startDate = $queryParams['start_date'] ?? now()->format('Y-m-d');
        $endDate = $queryParams['end_date'] ?? now()->addDay()->format('Y-m-d');
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
}


