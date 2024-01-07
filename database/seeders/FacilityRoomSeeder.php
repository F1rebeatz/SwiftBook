<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\FacilityRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacilityRoom::factory()->count(100)->create();
    }
}
