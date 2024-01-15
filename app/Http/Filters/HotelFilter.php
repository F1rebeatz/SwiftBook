<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class HotelFilter extends AbstractFilter
{
    public const SEARCH_QUERY = 'search';
    public const FACILITIES = 'facilities';

    protected function getCallbacks(): array
    {
        return [
            self::SEARCH_QUERY => [$this, 'search'],
            self::FACILITIES => [$this, 'facilities'],
        ];
    }

    public function search(Builder $builder, $value): void
    {
        $builder->where(function ($q) use ($value) {
            $q->where('title', 'like', "%$value%")
                ->orWhere('address', 'like', "%$value%");
        });
    }

    public function facilities(Builder $builder, $value): void
    {
        if (!empty($value)) {
            $builder->whereHas('facilities', function ($q) use ($value) {
                $q->whereIn('facility_id', $value);
            }, '=', count($value));
        }
    }
}

