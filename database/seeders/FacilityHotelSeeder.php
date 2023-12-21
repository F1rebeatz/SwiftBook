<?php

namespace Database\Seeders;

use App\Models\FacilityHotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacilityHotel::factory()->count(30)->create();
    }
}
