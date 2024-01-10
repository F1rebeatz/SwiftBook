<?php

namespace App\Http\Filters;



use Illuminate\Database\Eloquent\Builder;

class HotelFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';
    public const ADDRESS = 'address';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self:: DESCRIPTION => [$this, 'description'],
            self::ADDRESS => [$this, 'address'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function description(Builder $builder, $value)
    {
        $builder->where('description', 'like', "%{$value}%");
    }

    public function address(Builder $builder, $value)
    {
        $builder->where('address', 'like', "%{$value}%");
    }
}
