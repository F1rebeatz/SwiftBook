<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = ['title', 'description', 'price', 'poster_url', 'hotel_id', 'floor_area', 'type'];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(FacilityRoom::class);
    }
}
