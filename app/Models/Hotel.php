<?php

namespace App\Models;


use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;
    use Filterable;
    protected $table = 'hotels';
    protected $fillable = ['title','description','poster_url','address'];

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'facility_hotel', 'hotel_id', 'facility_id');
    }

    public function rooms(): HasMany {
        return $this->hasMany(Room::class);
    }
}
