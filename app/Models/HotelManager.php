<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelManager extends Model
{
    use HasFactory;

    protected $table = 'hotel_managers';
    protected $fillable = ['user_id', 'hotel_id'];
}
