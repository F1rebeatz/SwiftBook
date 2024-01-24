<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function managedHotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'hotel_managers');
    }
}
