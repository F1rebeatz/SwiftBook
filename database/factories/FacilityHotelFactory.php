<?php

namespace Database\Factories;

use App\Models\Facility;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FacilityHotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'facility_id' => function () {
                return Facility::inRandomOrder()->firstOrCreate()->id;
            },
            'hotel_id' => function () {
                return Hotel::inRandomOrder()->firstOrCreate()->id;
            },
        ];
    }
}
