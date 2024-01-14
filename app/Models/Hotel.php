<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Attributes\SearchUsingFullText;
class Hotel extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'hotels';
    protected $fillable = ['title', 'description', 'poster_url', 'address'];

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'facility_hotel', 'hotel_id', 'facility_id');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
