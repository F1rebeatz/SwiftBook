<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'started_at',
        'finished_at',
        'days',
        'price',
    ];
    protected $table = 'bookings';

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeManagerHotel($query)
    {
        if (auth()->user()?->hasRole('manager')) {
            return $query->whereIn('room_id', Room::whereHas('hotel', function ($query) {
                $query->whereIn('id', auth()->user()->managedHotels->pluck('id'));
            })->pluck('id'));
        }

        return $query;
    }
}
